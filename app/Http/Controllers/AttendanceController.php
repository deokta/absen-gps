<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Office;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AttendanceController extends Controller
{
    // 1. Menampilkan Halaman Kamera & Map
    public function index()
    {
        $office = Office::first(); // Mengambil data lokasi kantor
        return view('absen', compact('office'));
    }

    // 2. Logika Menyimpan Absensi
    public function store(Request $request)
    {
        $user = Auth::user();
        $office = Office::first();

        // Validasi input
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
            'photo' => 'required',
            'type' => 'required|in:in,out'
        ]);

        // A. Hitung Jarak dengan Rumus Haversine
        $distance = $this->calculateDistance(
            $request->latitude, $request->longitude,
            $office->latitude, $office->longitude
        );

        // B. Cek apakah user berada di dalam radius (misal 100 meter)
        if ($distance > $office->radius) {
            return response()->json([
                'message' => "Anda terlalu jauh! Jarak Anda " . round($distance) . " meter dari kantor."
            ], 422);
        }

        // C. Olah Foto Base64 dari Webcam.js
        $img = $request->photo;
        
        // Pastikan folder ada, jika tidak, buat foldernya
        if (!Storage::exists('public/absensi')) {
            Storage::makeDirectory('public/absensi');
        }

        $image_parts = explode(";base64,", $img);
        $image_base64 = base64_decode($image_parts[1]);
        
        $fileName = $user->id . '_' . time() . '.png';
        
        // Simpan langsung ke disk public agar link storage berfungsi
        Storage::disk('public')->put('absensi/' . $fileName, $image_base64);

        // D. Simpan ke Database
        Attendance::create([
            'user_id' => $user->id,
            'office_id' => $office->id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'photo' => 'absensi/' . $fileName, // Simpan dengan nama folder agar mudah dipanggil di view
            'type' => $request->type
        ]);

        return response()->json(['message' => 'Berhasil absen ' . $request->type]);
    }

    // Fungsi Tambahan: Rumus Haversine (Matematika Geospasial)
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000; // dalam meter
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        return $earthRadius * $c;
    }
}