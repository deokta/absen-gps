<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            // Menambah kolom untuk menyimpan koordinat GPS dan Alamat
            $table->string('latitude')->nullable()->after('status');
            $table->string('longitude')->nullable()->after('latitude');
            $table->text('address')->nullable()->after('longitude');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            // Menghapus kolom jika migration di-rollback
            $table->dropColumn(['latitude', 'longitude', 'address']);
        });
    }
};