<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

    // Tambahkan baris di bawah ini untuk memberi izin pengisian data
    protected $fillable = ['name', 'latitude', 'longitude', 'radius'];
}