<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi untuk menambah kolom.
     */
    public function up(): void
    {
        // Cek dulu apakah tabel users ada sebelum menambah kolom
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                // Tambah kolom nik setelah id
                if (!Schema::hasColumn('users', 'nik')) {
                    $table->string('nik')->unique()->nullable()->after('id');
                }
                
                // Tambah kolom avatar setelah email
                if (!Schema::hasColumn('users', 'avatar')) {
                    $table->string('avatar')->nullable()->after('email');
                }
            });
        }
    }

    /**
     * Batalkan migrasi (Hapus kolom).
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nik', 'avatar']);
        });
    }
};