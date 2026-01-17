<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat Akun Admin
        User::create([
            'name' => 'Admin Boss',
            'email' => 'admin@absen.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Membuat Akun Karyawan
        User::create([
            'name' => 'Karyawan Rajin',
            'email' => 'karyawan@absen.com',
            'password' => Hash::make('password'),
            'role' => 'karyawan',
        ]);
    }
}