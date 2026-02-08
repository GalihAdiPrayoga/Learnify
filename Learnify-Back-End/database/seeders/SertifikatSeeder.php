<?php

namespace Database\Seeders;

use App\Models\Sertifikat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SertifikatSeeder extends Seeder
{
    public function run(): void
    {
        // Get all completed enrollments
        $completedEnrollments = DB::table('kelas_user')
            ->where('status', 'completed')
            ->get();

        foreach ($completedEnrollments as $enrollment) {
            $exists = Sertifikat::where('user_id', $enrollment->user_id)
                ->where('kelas_id', $enrollment->kelas_id)
                ->exists();

            if ($exists)
                continue;

            $tanggalTerbit = $enrollment->completed_at ?? now();

            Sertifikat::create([
                'user_id' => $enrollment->user_id,
                'kelas_id' => $enrollment->kelas_id,
                'nomor_sertifikat' => 'CERT-' . date('Ymd', strtotime($tanggalTerbit)) . '-' . $enrollment->kelas_id . '-' . $enrollment->user_id,
                'tanggal_terbit' => $tanggalTerbit,
            ]);
        }
    }
}
