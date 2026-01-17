<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Karena kita menghapus $table->timestamps() di migrasi,
     * kita harus memberitahu Laravel agar tidak mencari kolom created_at & updated_at.
     */
    public $timestamps = false;

    /**
     * Kolom yang boleh diisi secara massal.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nik',
        'avatar',
    ];

    /**
     * Kolom yang disembunyikan saat data ditampilkan (misal dalam API).
     */
    protected $hidden = [
        'password',
        // 'remember_token', // Hapus ini karena kolomnya sudah tidak ada di database
    ];

    /**
     * Casting tipe data.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}