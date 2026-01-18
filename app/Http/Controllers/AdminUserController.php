<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'member')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.users.index', compact('users'));
    }

    public function approve(User $user)
    {
        $user->update([
            'is_active' => 1,
        ]);

        return back()->with('success', 'User approved');
    }
}
