<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Sertifikat;
use App\Models\HasilUjian;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreKelasRequest;
use App\Http\Requests\UpdateKelasRequest;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * GET /kelas/public - Get all available classes (public access, no authentication)
     */
    public function publicIndex()
    {
        try {
            $kelas = Kelas::with('materi')->latest()->get();

            $kelas = $kelas->map(function ($k) {
                return [
                    'id' => $k->id,
                    'nama' => $k->nama,
                    'thumnail' => $k->thumnail,
                    'created_at' => $k->created_at,
                    'totalMaterials' => $k->materi->count(),
                    'progress' => 0,
                    'completedMaterials' => [],
                    'isInProgress' => false,
                    'enrolledAt' => null,
                    'isEnrolled' => false,
                    'status' => null,
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $kelas
            ]);

        } catch (\Exception $e) {
            \Log::error('Error in KelasController@publicIndex: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memuat kelas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * GET /kelas/public/{id} - Get course detail (public, no auth)
     */
    public function publicShow($id)
    {
        try {
            $kelas = Kelas::with([
                'materi' => function ($q) {
                    $q->orderBy('urutan', 'asc');
                }
            ])->find($id);

            if (!$kelas) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kelas tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $kelas->id,
                    'nama' => $kelas->nama,
                    'thumnail' => $kelas->thumnail,
                    'created_at' => $kelas->created_at,
                    'totalMaterials' => $kelas->materi->count(),
                    'progress' => 0,
                    'completedMaterials' => [],
                    'isInProgress' => false,
                    'enrolledAt' => null,
                    'isEnrolled' => false,
                    'status' => null,
                    'materials' => $kelas->materi->map(function ($m) {
                        return [
                            'id' => $m->id,
                            'judul' => $m->judul,
                            'deskripsi' => $m->deskripsi,
                            'urutan' => $m->urutan,
                            'kelas_id' => $m->kelas_id,
                        ];
                    }),
                ]
            ]);

        } catch (\Exception $e) {
            \Log::error('Error in KelasController@publicShow: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * GET /user/kelas - Get all available classes with enrollment status
     */
    public function index()
    {
        try {
            $user = auth()->user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 401);
            }

            $kelas = Kelas::with('materi')->latest()->get();

            // Add enrollment status for each class
            $kelas = $kelas->map(function ($k) use ($user) {
                // Check if user enrolled
                $enrollment = $user->kelas()
                    ->where('kelas_id', $k->id)
                    ->withPivot(['completed_materials', 'progress', 'status', 'completed_at'])
                    ->first();

                $completedMaterials = [];
                $progress = 0;
                $isInProgress = false;
                $status = null;

                if ($enrollment) {
                    $completedMaterials = json_decode($enrollment->pivot->completed_materials ?? '[]', true);
                    $progress = $enrollment->pivot->progress ?? 0;
                    $status = $enrollment->pivot->status ?? 'active';
                    $isInProgress = true;
                }

                return [
                    'id' => $k->id,
                    'nama' => $k->nama,
                    'thumnail' => $k->thumnail,
                    'created_at' => $k->created_at,
                    'totalMaterials' => $k->materi->count(),
                    'progress' => $progress,
                    'completedMaterials' => $completedMaterials,
                    'isInProgress' => $isInProgress,
                    'enrolledAt' => $enrollment ? $enrollment->pivot->created_at : null,
                    'isEnrolled' => $enrollment !== null,
                    'status' => $status,
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $kelas
            ]);

        } catch (\Exception $e) {
            \Log::error('Error in KelasController@index: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memuat kelas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * POST /kelas
     */
    public function store(StoreKelasRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('thumnail')) {
            $data['thumnail'] = $request->file('thumnail')
                ->store('kelas', 'public');
        }

        $kelas = Kelas::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Kelas berhasil dibuat',
            'data' => $kelas
        ], 201);
    }

    /**
     * GET /kelas/{kelas}
     */
    public function show(Kelas $kelas)
    {
        $kelas->load('materi', 'users');

        return response()->json([
            'success' => true,
            'data' => $kelas
        ]);
    }

    /**
     * PUT /kelas/{kelas}
     */
    public function update(UpdateKelasRequest $request, Kelas $kelas)
    {
        $data = $request->validated();

        if ($request->hasFile('thumnail')) {
            // hapus thumnail lama
            if ($kelas->thumnail) {
                Storage::disk('public')->delete($kelas->thumnail);
            }

            $data['thumnail'] = $request->file('thumnail')
                ->store('kelas', 'public');
        }

        $kelas->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Kelas berhasil diperbarui',
            'data' => $kelas
        ]);
    }

    /**
     * DELETE /kelas/{kelas}
     */
    public function destroy(Kelas $kelas)
    {
        if ($kelas->thumnail) {
            Storage::disk('public')->delete($kelas->thumnail);
        }

        $kelas->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kelas berhasil dihapus'
        ]);
    }

    /**
     * GET /kelas/my-courses - Get courses for current user with progress
     */
    public function myCourses()
    {
        try {
            $user = auth()->user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 401);
            }

            $kelas = $user->kelas()
                ->withPivot(['completed_materials', 'progress', 'status', 'completed_at', 'created_at'])
                ->with('materi')
                ->get()
                ->map(function ($k) {
                    $completedMaterials = json_decode($k->pivot->completed_materials ?? '[]', true);
                    $progress = $k->pivot->progress ?? 0;

                    return [
                        'id' => $k->id,
                        'nama' => $k->nama,
                        'thumnail' => $k->thumnail,
                        'created_at' => $k->created_at,
                        'totalMaterials' => $k->materi->count(),
                        'progress' => $progress,
                        'completedMaterials' => $completedMaterials,
                        'isInProgress' => true,
                        'enrolledAt' => $k->pivot->created_at,
                        'isEnrolled' => true,
                        'status' => $k->pivot->status ?? 'active',
                        'completedAt' => $k->pivot->completed_at,
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $kelas
            ]);

        } catch (\Exception $e) {
            \Log::error('Error in KelasController@myCourses: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memuat kelas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * POST /kelas/{kelas}/toggle-material - Toggle material completion
     */
    public function toggleMaterial(Kelas $kelas, Request $request)
    {
        try {
            $request->validate([
                'material_id' => 'required|integer',
                'action' => 'nullable|string|in:complete,toggle'
            ]);

            $user = auth()->user();
            $materialId = $request->material_id;
            $action = $request->input('action', 'toggle');

            // Check if user enrolled in this kelas
            $pivot = $user->kelas()
                ->where('kelas_id', $kelas->id)
                ->withPivot(['completed_materials', 'progress', 'status'])
                ->first();

            if (!$pivot) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda belum terdaftar di kelas ini'
                ], 403);
            }

            // Get current completed materials
            $completed = json_decode($pivot->pivot->completed_materials ?? '[]', true);

            // Ensure array of integers
            $completed = array_map('intval', $completed);
            $materialId = intval($materialId);

            if ($action === 'complete') {
                // Only add if not already completed (idempotent)
                if (!in_array($materialId, $completed)) {
                    $completed[] = $materialId;
                }
            } else {
                // Toggle completion
                if (in_array($materialId, $completed)) {
                    $completed = array_values(array_diff($completed, [$materialId]));
                } else {
                    $completed[] = $materialId;
                }
            }

            // Calculate progress
            $totalMaterials = $kelas->materi()->count();
            $progress = $totalMaterials > 0
                ? round((count($completed) / $totalMaterials) * 100)
                : 0;

            // Update pivot
            $user->kelas()->updateExistingPivot($kelas->id, [
                'completed_materials' => json_encode(array_values($completed)),
                'progress' => $progress
            ]);

            // Check if course should be marked as completed
            $courseCompleted = $this->checkAndCompleteCourse($user, $kelas, $completed, $totalMaterials);

            return response()->json([
                'success' => true,
                'data' => [
                    'completed' => $completed,
                    'progress' => $progress,
                    'courseCompleted' => $courseCompleted,
                ]
            ]);

        } catch (\Exception $e) {
            \Log::error('Error in KelasController@toggleMaterial: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengubah status materi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * POST /kelas/{kelas}/start - Start a course
     */
    public function startCourse(Kelas $kelas)
    {
        try {
            $user = auth()->user();

            // Check if already enrolled
            $exists = $user->kelas()->where('kelas_id', $kelas->id)->exists();

            if (!$exists) {
                // Enroll user
                $user->kelas()->attach($kelas->id, [
                    'completed_materials' => json_encode([]),
                    'progress' => 0,
                    'status' => 'active',
                ]);
            }

            // Return updated course data
            $enrollment = $user->kelas()
                ->where('kelas_id', $kelas->id)
                ->withPivot(['completed_materials', 'progress', 'status', 'created_at'])
                ->first();

            $kelas->load('materi');

            return response()->json([
                'success' => true,
                'message' => $exists ? 'Anda sudah terdaftar di kelas ini' : 'Berhasil memulai kelas',
                'data' => [
                    'id' => $kelas->id,
                    'nama' => $kelas->nama,
                    'thumnail' => $kelas->thumnail,
                    'created_at' => $kelas->created_at,
                    'totalMaterials' => $kelas->materi->count(),
                    'progress' => $enrollment->pivot->progress ?? 0,
                    'completedMaterials' => json_decode($enrollment->pivot->completed_materials ?? '[]', true),
                    'isInProgress' => true,
                    'enrolledAt' => $enrollment->pivot->created_at,
                    'isEnrolled' => true,
                    'status' => $enrollment->pivot->status ?? 'active',
                ]
            ]);

        } catch (\Exception $e) {
            \Log::error('Error in KelasController@startCourse: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal memulai kelas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * DELETE /kelas/{kelas}/cancel - Cancel/remove course from progress
     */
    public function cancelCourse(Kelas $kelas)
    {
        try {
            $user = auth()->user();

            $user->kelas()->detach($kelas->id);

            return response()->json([
                'success' => true,
                'message' => 'Kelas berhasil dihapus dari progress'
            ]);

        } catch (\Exception $e) {
            \Log::error('Error in KelasController@cancelCourse: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus kelas dari progress',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Check if all materials are completed and all exams passed,
     * then mark course as completed and generate certificate.
     */
    private function checkAndCompleteCourse($user, Kelas $kelas, array $completed, int $totalMaterials): bool
    {
        // All materials must be completed
        if (count($completed) < $totalMaterials || $totalMaterials === 0) {
            return false;
        }

        // Check all materials that have exams - user must have passed them (nilai >= 70)
        $materiIds = $kelas->materi()->pluck('id')->toArray();
        $materiWithSoal = $kelas->materi()->has('soals')->pluck('id')->toArray();

        foreach ($materiWithSoal as $materiId) {
            $passed = HasilUjian::where('user_id', $user->id)
                ->where('materi_id', $materiId)
                ->where('lulus', true)
                ->exists();

            if (!$passed) {
                return false;
            }
        }

        // All conditions met - mark course as completed
        $user->kelas()->updateExistingPivot($kelas->id, [
            'status' => 'completed',
            'completed_at' => now(),
            'progress' => 100,
        ]);

        // Generate certificate if not already exists
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
