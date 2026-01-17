<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Ambil 5 riwayat absen terakhir
        $absensi = Attendance::where('user_id', $userId)
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get()
                    ->map(function ($item) {
                        // Logika sederhana untuk status (bisa kamu sesuaikan nanti)
                        $item->status = $item->attendance_time > '08:00:00' ? 'Terlambat' : 'Tepat Waktu';
                        $item->type = $item->type ?? 'in'; // default 'in' jika belum ada kolom type
                        return $item;
                    });

        // Ambil riwayat izin/cuti dari tabel leaves (pakai DB query agar cepat)
        $izin = DB::table('leaves')
                    ->where('user_id', $userId)
                    ->orderBy('date', 'desc')
                    ->take(5)
                    ->get();

        return view('dashboard', compact('absensi', 'izin'));
    }
}