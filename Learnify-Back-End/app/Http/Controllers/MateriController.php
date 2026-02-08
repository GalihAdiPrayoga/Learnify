<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMateriRequest;
use App\Http\Requests\UpdateMateriRequest;

class MateriController extends Controller
{
    /**
     * GET /materi
     */
    public function index(Request $request)
    {
        $query = Materi::withoutGlobalScopes()->with('kelas');

        if ($request->query('kelas_id')) {
            $query->where('kelas_id', $request->query('kelas_id'));
        }

        $materi = $query->orderBy('urutan', 'asc')->orderBy('created_at', 'asc')->get()->map(function ($m) {
            $m->kelas_nama = $m->kelas ? $m->kelas->nama : null;
            return $m;
        });

        return response()->json([
            'success' => true,
            'data' => $materi
        ]);
    }


    /**
     * POST /materi
     */
    public function store(StoreMateriRequest $request)
    {
        $data = $request->validated();

        // Auto-set urutan if not provided
        if (!isset($data['urutan']) || $data['urutan'] == 0) {
            $maxUrutan = Materi::where('kelas_id', $data['kelas_id'])->max('urutan') ?? 0;
            $data['urutan'] = $maxUrutan + 1;
        }

        $materi = Materi::create($data);
        $materi->load('kelas');
        $materi->kelas_nama = $materi->kelas ? $materi->kelas->nama : null;

        return response()->json([
            'success' => true,
            'message' => 'Materi berhasil ditambahkan',
            'data' => $materi
        ], 201);
    }

    /**
     * GET /materi/{materi}
     */
    public function show(Materi $materi)
    {
        $materi->load('kelas');

        return response()->json([
            'success' => true,
            'data' => $materi
        ]);
    }

    /**
     * PUT /materi/{materi}
     */
    public function update(UpdateMateriRequest $request, Materi $materi)
    {
        $data = $request->validated();
        $materi->update($data);
        $materi->load('kelas');
        $materi->kelas_nama = $materi->kelas ? $materi->kelas->nama : null;

        return response()->json([
            'success' => true,
            'message' => 'Materi berhasil diperbarui',
            'data' => $materi
        ]);
    }

    /**
     * DELETE /materi/{materi}
     */
    public function destroy(Materi $materi)
    {
        $materi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Materi berhasil dihapus'
        ]);
    }

    /**
     * GET /user/materi/kelas/{kelas_id}
     * Endpoint untuk user melihat materi berdasarkan kelas, with sequential lock info
     */
    public function getByKelas($kelas_id)
    {
        $kelas = Kelas::find($kelas_id);

        if (!$kelas) {
            return response()->json([
                'success' => false,
                'message' => 'Kelas tidak ditemukan',
                'data' => []
            ], 404);
        }

        $user = auth()->user();

        // Check enrollment
        $enrollment = $user->kelas()
            ->where('kelas_id', $kelas_id)
            ->withPivot(['completed_materials', 'progress', 'status'])
            ->first();

        if (!$enrollment) {
            return response()->json([
                'success' => false,
                'message' => 'Anda belum terdaftar di kelas ini',
                'data' => []
            ], 403);
        }

        $completedMaterials = json_decode($enrollment->pivot->completed_materials ?? '[]', true);
        $completedMaterials = array_map('intval', $completedMaterials);

        $materi = Materi::with('kelas')
            ->where('kelas_id', $kelas_id)
            ->orderBy('urutan', 'asc')
            ->orderBy('created_at', 'asc')
            ->get();

        $result = [];
        $previousCompleted = true; // First material is always unlocked

        foreach ($materi as $index => $m) {
            $isCompleted = in_array($m->id, $completedMaterials);
            $isLocked = !$previousCompleted;

            $result[] = [
                'id' => $m->id,
                'judul' => $m->judul,
                'deskripsi' => $m->deskripsi,
                'konten' => $m->konten,
                'kelas_id' => $m->kelas_id,
                'kelas_nama' => $m->kelas ? $m->kelas->nama : null,
                'urutan' => $m->urutan,
                'created_at' => $m->created_at,
                'updated_at' => $m->updated_at,
                'is_locked' => $isLocked,
                'is_completed' => $isCompleted,
            ];

            // Next material is unlocked only if this one is completed
            $previousCompleted = $isCompleted;
        }

        return response()->json([
            'success' => true,
            'data' => $result
        ]);
    }

    /**
     * GET /user/materi/{id}
     * Endpoint untuk user melihat detail materi (with sequential access check)
     */
    public function getDetailForUser($id)
    {
        $materi = Materi::with('kelas')->find($id);

        if (!$materi) {
            return response()->json([
                'success' => false,
                'message' => 'Materi tidak ditemukan'
            ], 404);
        }

        $user = auth()->user();

        // Check enrollment
        $enrollment = $user->kelas()
            ->where('kelas_id', $materi->kelas_id)
            ->withPivot(['completed_materials'])
            ->first();

        if (!$enrollment) {
            return response()->json([
                'success' => false,
                'message' => 'Anda belum terdaftar di kelas ini'
            ], 403);
        }

        // Check sequential access - get all materials in this kelas ordered by urutan
        $allMaterials = Materi::where('kelas_id', $materi->kelas_id)
            ->orderBy('urutan', 'asc')
            ->orderBy('created_at', 'asc')
            ->get();

        $completedMaterials = json_decode($enrollment->pivot->completed_materials ?? '[]', true);
        $completedMaterials = array_map('intval', $completedMaterials);

        // Check if previous materials are completed
        foreach ($allMaterials as $m) {
            if ($m->id === $materi->id) {
                break; // Reached the requested material, it's accessible
            }
            if (!in_array($m->id, $completedMaterials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda harus menyelesaikan materi sebelumnya terlebih dahulu'
                ], 403);
            }
        }

        $materi->kelas_nama = $materi->kelas ? $materi->kelas->nama : null;

        return response()->json([
            'success' => true,
            'data' => $materi
        ]);
    }
}
