<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Membuat Akun Admin
        User::factory()->create([
            'name' => 'Administrator',
            'nik' => '10000001', // Tambahkan NIK unik
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'),
        ]);

        // 2. Membuat Akun Karyawan Contoh
        User::factory()->create([
            'name' => 'Budi Setiawan',
            'nik' => '20000001', // Tambahkan NIK unik
            'email' => 'karyawan@gmail.com',
            'password' => Hash::make('password123'),
        ]);

        // 3. Opsi: Membuat 5 Karyawan Tambahan secara acak (Random)
        // Jika kamu menggunakan factory, pastikan Factory User sudah punya kolom NIK juga
        // User::factory(5)->create();
    }
}