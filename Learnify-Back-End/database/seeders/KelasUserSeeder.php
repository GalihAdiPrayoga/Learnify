<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Materi;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasUserSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::role('User')->get();
        $kelasList = Kelas::with([
            'materi' => function ($q) {
                $q->orderBy('urutan', 'asc');
            }
        ])->get();

        if ($users->isEmpty() || $kelasList->isEmpty())
            return;

        foreach ($users as $index => $user) {
            // Each user enrolls in 3-6 courses with varying progress
            $enrollCount = min(($index % 5) + 3, $kelasList->count());
            $selectedKelas = $kelasList->shuffle()->take($enrollCount);

            foreach ($selectedKelas as $ki => $kelas) {
                $materiIds = $kelas->materi->pluck('id')->toArray();
                $totalMateri = count($materiIds);

                if ($totalMateri === 0)
                    continue;

                // Vary progress based on position
                $scenario = ($index + $ki) % 5;

                switch ($scenario) {
                    case 0: // Completed course
                        $completedMaterials = $materiIds;
                        $progress = 100;
                        $status = 'completed';
                        $completedAt = now()->subDays(rand(1, 30));
                        break;
                    case 1: // Almost done (all but last)
                        $completedMaterials = array_slice($materiIds, 0, max(1, $totalMateri - 1));
                        $progress = (int) round((count($completedMaterials) / $totalMateri) * 100);
                        $status = 'active';
                        $completedAt = null;
                        break;
                    case 2: // Half done
                        $halfCount = max(1, (int) ceil($totalMateri / 2));
                        $completedMaterials = array_slice($materiIds, 0, $halfCount);
                        $progress = (int) round(($halfCount / $totalMateri) * 100);
                        $status = 'active';
                        $completedAt = null;
                        break;
                    case 3: // Just started (first material only)
                        $completedMaterials = array_slice($materiIds, 0, 1);
                        $progress = (int) round((1 / $totalMateri) * 100);
                        $status = 'active';
                        $completedAt = null;
                        break;
                    case 4: // Just enrolled, nothing done
                        $completedMaterials = [];
                        $progress = 0;
                        $status = 'active';
                        $completedAt = null;
                        break;
                }

                // Check if enrollment already exists
                $exists = DB::table('kelas_user')
                    ->where('user_id', $user->id)
                    ->where('kelas_id', $kelas->id)
                    ->exists();

                if (!$exists) {
                    DB::table('kelas_user')->insert([
                        'user_id' => $user->id,
                        'kelas_id' => $kelas->id,
                        'completed_materials' => json_encode($completedMaterials),
                        'progress' => $progress,
                        'status' => $status,
                        'completed_at' => $completedAt,
                        'created_at' => now()->subDays(rand(10, 60)),
                        'updated_at' => now()->subDays(rand(0, 10)),
                    ]);
                }
            }
        }
    }
}
