<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'office_id',
        'nik', 
        'latitude', 
        'longitude', 
        'address', 
        'photo', 
        'type', 
        'status', // <--- Tadi di sini kurang koma, sekarang sudah ada
        'attendance_date', 
        'attendance_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    // Perbaikan URL Google Maps agar formatnya benar
    public function getGoogleMapsUrlAttribute()
    {
        if ($this->latitude && $this->longitude) {
            return "https://www.google.com/maps?q={$this->latitude},{$this->longitude}";
        }
        return null;
    }
}