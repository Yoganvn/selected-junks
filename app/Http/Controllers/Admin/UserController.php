<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // --- WEB VIEW (Untuk Tampilan Website) ---
public function index()
    {
        $users = User::latest()->get();
        
        // Tambahan Data Statistik
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $newUsersThisWeek = User::where('created_at', '>=', now()->subWeek())->count();

        return view('admin.users.index', compact('users', 'totalUsers', 'totalAdmins', 'newUsersThisWeek'));
    }

    // --- API & WEB LOGIC (Proses Hapus & Tambah) ---
    
    // 1. Tambah User Baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:user,admin'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        // Respon beda kalau dipanggil dari API (Postman) vs Web
        if ($request->wantsJson()) {
            return response()->json(['message' => 'User Created', 'data' => $user]);
        }
        return back()->with('success', 'User berhasil ditambahkan!');
    }

    // 2. Hapus User
    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'User Deleted']);
        }
        return back()->with('success', 'User berhasil dihapus!');
    }
}