<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHasilUjianRequest;
use App\Http\Requests\UpdateHasilUjianRequest;
use App\Models\HasilUjian;
use App\Models\Kelas;
use App\Models\Sertifikat;
use App\Models\Soal;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HasilUjianController extends Controller
{
    const PASSING_SCORE = 70;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hasil = HasilUjian::with(['user', 'materi'])->get();
        return response()->json([
            'success' => true,
            'data' => $hasil
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHasilUjianRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $hasil = HasilUjian::with(['materi.kelas', 'jawabanUsers.soal'])->find($id);

        if (!$hasil || $hasil->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Not found'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $hasil
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HasilUjian $hasilUjian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHasilUjianRequest $request, HasilUjian $hasilUjian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HasilUjian $hasilUjian)
    {
        $hasilUjian->delete();
        return response()->json(['success' => true, 'message' => 'Hasil ujian dihapus']);
    }

    /**
     * POST /user/hasil-ujian/start
     * Mulai ujian: buat record HasilUjian dengan nilai 0
     */
    public function start(Request $request)
    {
        $request->validate(['materi_id' => 'required|exists:materis,id']);

        // Guard: cek apakah sudah ada session aktif (dalam 1 jam terakhir)
        $existing = HasilUjian::where('user_id', Auth::id())
            ->where('materi_id', $request->materi_id)
            ->where('created_at', '>=', now()->subHour())
            ->where('nilai', 0)
            ->where('lulus', false)
            ->first();

        if ($existing) {
            return response()->json([
                'success' => true,
                'message' => 'Melanjutkan sesi ujian yang ada',
                'data' => $existing
            ]);
        }

        $soalCount = Soal::where('materi_id', $request->materi_id)->count();

        $hasil = HasilUjian::create([
            'user_id' => Auth::id(),
            'materi_id' => $request->materi_id,
            'jumlah_soal' => $soalCount,
            'jumlah_benar' => 0,
            'nilai' => 0,
            'lulus' => false,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Ujian dimulai',
            'data' => $hasil
        ], 201);
    }

    /**
     * POST /user/hasil-ujian/finish
     * Hitung nilai berdasarkan jawaban yang sudah disimpan.
     * Auto-marks material as completed and checks course completion on pass.
     */
    public function finish(Request $request)
    {
        $request->validate(['hasil_ujian_id' => 'required|exists:hasil_ujians,id']);

        $hasil = HasilUjian::with('jawabanUsers.soal')->find($request->hasil_ujian_id);

        if (!$hasil || $hasil->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $forceFail = (bool) $request->input('force_fail', false);

        // If already finished, return existing
        if ($hasil->nilai > 0 || $hasil->jumlah_benar > 0 || $hasil->updated_at->diffInSeconds($hasil->created_at) > 5) {
            return response()->json([
                'success' => true,
                'message' => 'Ujian sudah selesai sebelumnya',
                'data' => $hasil
            ]);
        }

        // If time expired and caller requested force-fail
        if ($forceFail) {
            $hasil->update([
                'jumlah_benar' => 0,
                'nilai' => 0,
                'lulus' => false,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Waktu habis. Ujian dinyatakan gagal.',
                'data' => $hasil->fresh(['jawabanUsers.soal'])
            ]);
        }

        $jumlahBenar = $hasil->jawabanUsers->where('jawaban_benar', true)->count();
        $jumlahSoal = $hasil->jumlah_soal;
        $nilai = $jumlahSoal > 0 ? round(($jumlahBenar / $jumlahSoal) * 100) : 0;
        $lulus = $nilai >= self::PASSING_SCORE;

        $hasil->update([
            'jumlah_benar' => $jumlahBenar,
            'nilai' => $nilai,
            'lulus' => $lulus,
        ]);

        $courseCompleted = false;

        // If passed, auto-mark the material as completed in user's enrolled course
        if ($lulus) {
            $courseCompleted = $this->autoCompleteMaterial($hasil);
        }

        $freshHasil = $hasil->fresh(['jawabanUsers.soal']);

        return response()->json([
            'success' => true,
            'message' => $lulus ? 'Selamat! Anda lulus ujian.' : 'Anda belum lulus. Nilai minimum: ' . self::PASSING_SCORE,
            'data' => $freshHasil,
            'lulus' => $lulus,
            'courseCompleted' => $courseCompleted,
        ]);
    }

    /**
     * GET /user/hasil-ujian (history for current user)
     */
    public function userHistory()
    {
        $history = HasilUjian::with(['materi.kelas'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $history
        ]);
    }

    /**
     * Auto-mark material as completed when exam is passed,
     * then check if the entire course should be marked as completed.
     */
    private function autoCompleteMaterial(HasilUjian $hasil): bool
    {
        $user = Auth::user();
        $materi = Materi::find($hasil->materi_id);

        if (!$materi) {
            return false;
        }

        $kelas = Kelas::find($materi->kelas_id);
        if (!$kelas) {
            return false;
        }

        // Get enrollment
        $enrollment = $user->kelas()
            ->where('kelas_id', $kelas->id)
            ->withPivot(['completed_materials', 'progress'])
            ->first();

        if (!$enrollment) {
            return false;
        }

        $completed = json_decode($enrollment->pivot->completed_materials ?? '[]', true);
        $completed = array_map('intval', $completed);
        $materialId = intval($materi->id);

        // Add material to completed if not already
        if (!in_array($materialId, $completed)) {
            $completed[] = $materialId;

            $totalMaterials = $kelas->materi()->count();
            $progress = $totalMaterials > 0
                ? round((count($completed) / $totalMaterials) * 100)
                : 0;

            $user->kelas()->updateExistingPivot($kelas->id, [
                'completed_materials' => json_encode(array_values($completed)),
                'progress' => $progress,
            ]);
        }

        // Check if entire course is completed
        $totalMaterials = $kelas->materi()->count();

        if (count($completed) >= $totalMaterials && $totalMaterials > 0) {
            // Verify all materials with exams are passed
            $materiWithSoal = $kelas->materi()->has('soals')->pluck('id')->toArray();

            $allPassed = true;
            foreach ($materiWithSoal as $mId) {
                $passed = HasilUjian::where('user_id', $user->id)
                    ->where('materi_id', $mId)
                    ->where('lulus', true)
                    ->exists();
                if (!$passed) {
                    $allPassed = false;
                    break;
                }
            }

            if ($allPassed) {
                $user->kelas()->updateExistingPivot($kelas->id, [
                    'status' => 'completed',
                    'completed_at' => now(),
                    'progress' => 100,
                ]);

                // Generate certificate
                $existingCert = Sertifikat::where('user_id', $user->id)
                    ->where('kelas_id', $kelas->id)
                    ->first();

                if (!$existingCert) {
                    Sertifikat::create([
                        'user_id' => $user->id,
                        'kelas_id' => $kelas->id,
                        'nomor_sertifikat' => 'CERT-' . now()->format('Ymd') . '-' . $kelas->id . '-' . $user->id,
                        'tanggal_terbit' => now()->toDateString(),
                    ]);
                }

                return true;
            }
        }

        return false;
    }
}
