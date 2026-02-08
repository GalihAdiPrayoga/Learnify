<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $userRole = Role::firstOrCreate(['name' => 'User']);

        // Admin accounts
        $admins = [
            ['name' => 'Admin', 'username' => 'admin', 'email' => 'admin@admin.com'],
            ['name' => 'Siti Nurhaliza', 'username' => 'siti.admin', 'email' => 'siti.admin@learnify.com'],
            ['name' => 'Budi Setiawan', 'username' => 'budi.admin', 'email' => 'budi.admin@learnify.com'],
        ];

        foreach ($admins as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'username' => $data['username'],
                    'password' => Hash::make('admin123'),
                ]
            );
            $user->assignRole($adminRole);
        }

        // Regular user accounts
        $users = [
            ['name' => 'User', 'username' => 'user', 'email' => 'user@user.com'],
            ['name' => 'Ahmad Fauzi', 'username' => 'ahmad.fauzi', 'email' => 'ahmad.fauzi@gmail.com'],
            ['name' => 'Dewi Lestari', 'username' => 'dewi.lestari', 'email' => 'dewi.lestari@gmail.com'],
            ['name' => 'Rizky Pratama', 'username' => 'rizky.pratama', 'email' => 'rizky.pratama@gmail.com'],
            ['name' => 'Nurul Hidayah', 'username' => 'nurul.hidayah', 'email' => 'nurul.hidayah@gmail.com'],
            ['name' => 'Eko Saputra', 'username' => 'eko.saputra', 'email' => 'eko.saputra@gmail.com'],
            ['name' => 'Putri Rahayu', 'username' => 'putri.rahayu', 'email' => 'putri.rahayu@gmail.com'],
            ['name' => 'Dimas Ardiansyah', 'username' => 'dimas.ardiansyah', 'email' => 'dimas.ardiansyah@gmail.com'],
            ['name' => 'Fitriani Sari', 'username' => 'fitriani.sari', 'email' => 'fitriani.sari@gmail.com'],
            ['name' => 'Hendra Gunawan', 'username' => 'hendra.gunawan', 'email' => 'hendra.gunawan@gmail.com'],
            ['name' => 'Rina Wati', 'username' => 'rina.wati', 'email' => 'rina.wati@gmail.com'],
            ['name' => 'Yoga Permana', 'username' => 'yoga.permana', 'email' => 'yoga.permana@gmail.com'],
            ['name' => 'Sinta Dewi', 'username' => 'sinta.dewi', 'email' => 'sinta.dewi@gmail.com'],
            ['name' => 'Arif Budiman', 'username' => 'arif.budiman', 'email' => 'arif.budiman@gmail.com'],
            ['name' => 'Lina Marlina', 'username' => 'lina.marlina', 'email' => 'lina.marlina@gmail.com'],
            ['name' => 'Fajar Nugroho', 'username' => 'fajar.nugroho', 'email' => 'fajar.nugroho@gmail.com'],
            ['name' => 'Mega Putri', 'username' => 'mega.putri', 'email' => 'mega.putri@gmail.com'],
            ['name' => 'Randi Wijaya', 'username' => 'randi.wijaya', 'email' => 'randi.wijaya@gmail.com'],
            ['name' => 'Ayu Lestari', 'username' => 'ayu.lestari', 'email' => 'ayu.lestari@gmail.com'],
            ['name' => 'Bagas Prabowo', 'username' => 'bagas.prabowo', 'email' => 'bagas.prabowo@gmail.com'],
            ['name' => 'Citra Anggraini', 'username' => 'citra.anggraini', 'email' => 'citra.anggraini@gmail.com'],
            ['name' => 'Doni Setiawan', 'username' => 'doni.setiawan', 'email' => 'doni.setiawan@gmail.com'],
            ['name' => 'Elsa Permata', 'username' => 'elsa.permata', 'email' => 'elsa.permata@gmail.com'],
            ['name' => 'Galih Pramudya', 'username' => 'galih.pramudya', 'email' => 'galih.pramudya@gmail.com'],
            ['name' => 'Indah Cahyani', 'username' => 'indah.cahyani', 'email' => 'indah.cahyani@gmail.com'],
        ];

        foreach ($users as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'username' => $data['username'],
                    'password' => Hash::make('user123'),
                ]
            );
            $user->assignRole($userRole);
        }
    }
}
