<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $kelasList = [
            ['nama' => 'Dasar Pemrograman Web'],
            ['nama' => 'Basis Data'],
            ['nama' => 'Jaringan Komputer'],
            ['nama' => 'Pemrograman Java'],
            ['nama' => 'Desain UI/UX'],
            ['nama' => 'Algoritma dan Struktur Data'],
            ['nama' => 'Sistem Operasi'],
            ['nama' => 'Pemrograman Python'],
            ['nama' => 'Keamanan Siber'],
            ['nama' => 'Cloud Computing'],
        ];

        foreach ($kelasList as $kelas) {
            Kelas::firstOrCreate(['nama' => $kelas['nama']]);
        }
    }
}
