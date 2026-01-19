<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'admin')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.users.index', compact('users'));
    }

    // APPROVE
    public function approve(User $user)
    {
        $user->update(['is_active' => 1]);

        return back()->with('success', 'User berhasil di-approve');
    }

    // NONAKTIFKAN
    public function disable(User $user)
    {
        if ($user->is_active == 0) {
            return back()->with('error', 'User sudah nonaktif');
        }

        $user->update(['is_active' => 0]);

        return back()->with('success', 'User berhasil dinonaktifkan');
    }

    // HAPUS (HANYA JIKA NONAKTIF)
    public function destroy(User $user)
    {
        if ($user->is_active == 1) {
            return back()->with('error', 'User aktif tidak boleh dihapus');
        }

        $user->delete();

        return back()->with('success', 'User berhasil dihapus');
    }
}
