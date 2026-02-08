<?php

namespace Database\Seeders;

use App\Models\HasilUjian;
use App\Models\JawabanUser;
use App\Models\Kelas;
use App\Models\Materi;
use App\Models\Soal;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HasilUjianSeeder extends Seeder
{
    public function run(): void
    {
        // Get all enrollments
        $enrollments = DB::table('kelas_user')->get();

        foreach ($enrollments as $enrollment) {
            $completedMaterials = json_decode($enrollment->completed_materials ?? '[]', true);
            $completedMaterials = array_map('intval', $completedMaterials);

            if (empty($completedMaterials))
                continue;

            // Create exam results for completed materials
            foreach ($completedMaterials as $materiId) {
                $materi = Materi::with('soals')->find($materiId);
                if (!$materi || $materi->soals->isEmpty())
                    continue;

                // Check if hasil already exists
                $exists = HasilUjian::where('user_id', $enrollment->user_id)
                    ->where('materi_id', $materiId)
                    ->exists();
                if ($exists)
                    continue;

                $soals = $materi->soals;
                $jumlahSoal = $soals->count();

                // Completed materials = passed exam (score >= 70)
                $minBenar = (int) ceil($jumlahSoal * 0.7);
                $jumlahBenar = rand($minBenar, $jumlahSoal);
                $nilai = (int) round(($jumlahBenar / $jumlahSoal) * 100);

                $hasil = HasilUjian::create([
                    'user_id' => $enrollment->user_id,
                    'materi_id' => $materiId,
                    'jumlah_soal' => $jumlahSoal,
                    'jumlah_benar' => $jumlahBenar,
                    'nilai' => $nilai,
                    'lulus' => true,
                ]);

                // Create jawaban_users for this exam
                $benarCount = 0;
                foreach ($soals as $soal) {
                    $isCorrect = $benarCount < $jumlahBenar;
                    $jawaban = $isCorrect ? $soal->jawaban_benar : $this->getWrongAnswer($soal->jawaban_benar);

                    JawabanUser::create([
                        'hasil_ujian_id' => $hasil->id,
                        'soal_id' => $soal->id,
                        'user_id' => $enrollment->user_id,
                        'jawaban_user' => $jawaban,
                        'jawaban_benar' => $isCorrect,
                    ]);

                    $benarCount++;
                }
            }

            // For active enrollments, sometimes add a failed attempt on the next unlocked material
            if ($enrollment->status === 'active' && !empty($completedMaterials)) {
                $kelas = Kelas::with([
                    'materi' => function ($q) {
                        $q->orderBy('urutan', 'asc');
                    }
                ])->find($enrollment->kelas_id);

                if (!$kelas)
                    continue;

                $allMateriIds = $kelas->materi->pluck('id')->toArray();
                $nextMateriIndex = count($completedMaterials);

                if ($nextMateriIndex < count($allMateriIds) && rand(0, 2) === 0) {
                    $nextMateriId = $allMateriIds[$nextMateriIndex];
                    $nextMateri = Materi::with('soals')->find($nextMateriId);

                    if ($nextMateri && $nextMateri->soals->isNotEmpty()) {
                        $exists = HasilUjian::where('user_id', $enrollment->user_id)
                            ->where('materi_id', $nextMateriId)
                            ->exists();

                        if (!$exists) {
                            $soals = $nextMateri->soals;
                            $jumlahSoal = $soals->count();
                            // Failed attempt: score < 70
                            $maxBenar = max(0, (int) ceil($jumlahSoal * 0.7) - 1);
                            $jumlahBenar = rand(0, $maxBenar);
                            $nilai = $jumlahSoal > 0 ? (int) round(($jumlahBenar / $jumlahSoal) * 100) : 0;

                            $hasil = HasilUjian::create([
                                'user_id' => $enrollment->user_id,
                                'materi_id' => $nextMateriId,
                                'jumlah_soal' => $jumlahSoal,
                                'jumlah_benar' => $jumlahBenar,
                                'nilai' => $nilai,
                                'lulus' => false,
                            ]);

                            $benarCount = 0;
                            foreach ($soals as $soal) {
                                $isCorrect = $benarCount < $jumlahBenar;
                                $jawaban = $isCorrect ? $soal->jawaban_benar : $this->getWrongAnswer($soal->jawaban_benar);

                                JawabanUser::create([
                                    'hasil_ujian_id' => $hasil->id,
                                    'soal_id' => $soal->id,
                                    'user_id' => $enrollment->user_id,
                                    'jawaban_user' => $jawaban,
                                    'jawaban_benar' => $isCorrect,
                                ]);

                                $benarCount++;
                            }
                        }
                    }
                }
            }
        }
    }

    private function getWrongAnswer(string $correctAnswer): string
    {
        $options = ['a', 'b', 'c', 'd'];
        $wrong = array_filter($options, fn($o) => $o !== $correctAnswer);
        return $wrong[array_rand($wrong)];
    }
}
