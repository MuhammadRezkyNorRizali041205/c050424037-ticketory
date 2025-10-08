<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RoleAndUserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat roles jika belum ada
        $roles = ['admin', 'technician', 'user'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // 🧑‍💼 Admin utama
        $admin = User::updateOrCreate(
            ['email' => 'admin123@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('123'),
            ]
        );
        $admin->syncRoles(['admin']);

        // 🔧 Technician (Hersan)
        $technician = User::updateOrCreate(
            ['email' => 'technician@gmail.com'], // sesuai input login kamu
            [
                'name' => 'technician',
                'password' => Hash::make('password'), // ubah kalau mau
            ]
        );
        $technician->syncRoles(['technician']);

        // 👤 User (Rezky)
        $user = User::updateOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'user',
                'password' => Hash::make('password'),
            ]
        );
        $user->syncRoles(['user']);
    }
}
