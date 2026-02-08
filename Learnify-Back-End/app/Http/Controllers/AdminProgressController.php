<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\HasilUjian;
use App\Models\Sertifikat;
use Illuminate\Support\Facades\DB;

class AdminProgressController extends Controller
{
    /**
     * GET /admin/progress - List all users with progress summary
     */
    public function index()
    {
        $users = User::role('User')
            ->with([
                'kelas' => function ($q) {
                    $q->withPivot(['completed_materials', 'progress', 'status', 'completed_at']);
                }
            ])
            ->withCount('sertifikats')
            ->get()
            ->map(function ($user) {
                $enrolledCourses = $user->kelas->count();
                $completedCourses = $user->kelas->filter(function ($k) {
                    return ($k->pivot->status ?? 'active') === 'completed';
                })->count();

                $avgProgress = $enrolledCourses > 0
                    ? round($user->kelas->avg(function ($k) {
                        return $k->pivot->progress ?? 0;
                    }))
                    : 0;

                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'username' => $user->username,
                    'created_at' => $user->created_at,
                    'enrolled_courses' => $enrolledCourses,
                    'completed_courses' => $completedCourses,
                    'avg_progress' => $avgProgress,
                    'certificates_count' => $user->sertifikats_count,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $users
        ]);
    }

    /**
     * GET /admin/progress/{userId} - Detailed progress for a specific user
     */
    public function show($userId)
    {
        $user = User::with([
            'kelas' => function ($q) {
                $q->withPivot(['completed_materials', 'progress', 'status', 'completed_at', 'created_at'])
                    ->with('materi');
            }
        ])->find($userId);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        $courses = $user->kelas->map(function ($kelas) use ($user) {
            $completedMaterials = json_decode($kelas->pivot->completed_materials ?? '[]', true);
            $totalMaterials = $kelas->materi->count();

            // Get exam results for this course's materials
            $materiIds = $kelas->materi->pluck('id')->toArray();
            $examResults = HasilUjian::where('user_id', $user->id)
                ->whereIn('materi_id', $materiIds)
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($h) {
                    return [
                        'id' => $h->id,
                        'materi_id' => $h->materi_id,
                        'nilai' => $h->nilai,
                        'lulus' => $h->lulus,
                        'jumlah_soal' => $h->jumlah_soal,
                        'jumlah_benar' => $h->jumlah_benar,
                        'created_at' => $h->created_at,
                    ];
                });

            // Check certificate
            $certificate = Sertifikat::where('user_id', $user->id)
                ->where('kelas_id', $kelas->id)
                ->first();

            return [
                'id' => $kelas->id,
                'nama' => $kelas->nama,
                'progress' => $kelas->pivot->progress ?? 0,
                'status' => $kelas->pivot->status ?? 'active',
                'enrolled_at' => $kelas->pivot->created_at,
                'completed_at' => $kelas->pivot->completed_at,
                'total_materials' => $totalMaterials,
                'completed_materials_count' => count($completedMaterials),
                'completed_materials' => $completedMaterials,
                'materials' => $kelas->materi->map(function ($m) use ($completedMaterials) {
                    return [
                        'id' => $m->id,
                        'judul' => $m->judul,
                        'urutan' => $m->urutan,
                        'is_completed' => in_array($m->id, $completedMaterials),
                    ];
                }),
                'exam_results' => $examResults,
                'certificate' => $certificate ? [
                    'id' => $certificate->id,
                    'nomor_sertifikat' => $certificate->nomor_sertifikat,
                    'tanggal_terbit' => $certificate->tanggal_terbit,
                ] : null,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'username' => $user->username,
                    'created_at' => $user->created_at,
                ],
                'courses' => $courses,
            ]
        ]);
    }
}
