<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserDeadlineController extends Controller
{
    public function index()
    {
        $users = User::all(); // Ambil semua user untuk admin kelola
        return view('admin.deadlines.index', compact('users'));
    }

    public function setDeadline(Request $request, User $user)
    {
        $request->validate([
            'deadline' => 'required|date|after_or_equal:today',
        ]);

        $user->update(['deadline' => $request->deadline]);

        return redirect()->back()->with('success', 'Deadline berhasil ditetapkan untuk user.');
    }

    // Fungsi untuk mengatur deadline semua user
    public function setGlobalDeadline(Request $request)
    {
        $request->validate([
            'deadline' => 'required|date|after_or_equal:today',
        ]);

        // Update semua user dengan deadline yang sama
        // User::whereNull('deadline')->orWhere('deadline', '!=', $request->deadline)->update([
        //     'deadline' => $request->deadline,
        // ]);
        // Update semua user dengan deadline yang baru
        User::query()->update(['deadline' => $request->deadline]);

        return redirect()->back()->with('success', 'Deadline berhasil diatur untuk semua user.');
    }
}
