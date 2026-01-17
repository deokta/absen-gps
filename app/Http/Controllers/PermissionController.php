<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    /**
     * Menampilkan form pengajuan izin/cuti
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Menyimpan data pengajuan ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'type' => 'required|in:sick,leave,late',
            'reason' => 'required',
            'document' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        // Simpan file jika ada
        $path = $request->file('document') ? $request->file('document')->store('permissions', 'public') : null;

        Permission::create([
            'user_id' => Auth::id(),
            'date' => $request->date,
            'type' => $request->type,
            'reason' => $request->reason,
            'document' => $path,
            'status' => 'pending', // Status default saat pertama kirim
        ]);

        return redirect()->route('dashboard')->with('success', 'Pengajuan berhasil dikirim!');
    }

    /**
     * Fungsi Baru: Update status oleh Admin (Approve/Reject)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected'
        ]);

        $permission = Permission::findOrFail($id);
        
        $permission->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status pengajuan berhasil diperbarui!');
    }
}