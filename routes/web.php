<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileUpdateController; // Tambahkan ini
use App\Models\Attendance;
use App\Models\Permission;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// --- DASHBOARD & ADMIN (Grup Auth & Verified) ---
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard Utama Karyawan
    Route::get('/dashboard', function () {
        $absensi = Attendance::where('user_id', Auth::id())->latest()->take(5)->get();
        $izin = Permission::where('user_id', Auth::id())->latest()->get();
        return view('dashboard', compact('absensi', 'izin'));
    })->name('dashboard');

    // Halaman Admin Rekap Seluruh Karyawan
    Route::get('/admin/absensi', function () {
        $semua_absensi = Attendance::with('user')->latest()->get();
        return view('admin-absensi', compact('semua_absensi'));
    })->name('admin.absensi');

    // Fitur Export Laporan untuk Admin
    Route::get('/admin/export-absensi', [AttendanceController::class, 'exportCSV'])->name('admin.export');

    // Proses Approval Izin oleh Admin
    Route::post('/admin/izin/{id}/status', [PermissionController::class, 'updateStatus'])->name('admin.izin.status');
});

// --- FITUR ABSENSI & IZIN ---
Route::middleware('auth')->group(function () {
    
    // 1. Menu Absensi
    Route::get('/absen/datang', [AttendanceController::class, 'index'])->name('absen.datang');
    Route::get('/absen/pulang', [AttendanceController::class, 'index'])->name('absen.pulang');
    Route::post('/absen/store', [AttendanceController::class, 'store'])->name('absen.store');

    // 2. Menu Izin, Cuti & Terlambat
    Route::get('/izin/ajukan', [PermissionController::class, 'create'])->name('izin.index');
    Route::post('/izin/store', [PermissionController::class, 'store'])->name('izin.store');

    // Alias Route
    Route::get('/cuti', [PermissionController::class, 'create'])->name('cuti.index');
});

// --- PROFILE & IDENTITY MANAGEMENT ---
Route::middleware('auth')->group(function () {
    // Fitur Update NIK & Foto (Yang baru kita buat)
    Route::get('/profile/edit-karyawan', [ProfileUpdateController::class, 'edit'])->name('profile.edit_karyawan');
    Route::patch('/profile/edit-karyawan', [ProfileUpdateController::class, 'update'])->name('profile.update_karyawan');

    // Profile Bawaan Laravel Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';