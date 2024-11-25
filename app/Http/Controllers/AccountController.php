<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    public function index()
    {
        // Ambil data user berdasarkan ID
        $user = Auth::user();


        return view('account.index', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',  // Ubah 'name' menjadi 'nama'
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nip' => 'nullable|string|max:255', // Ubah nip menjadi sesuai yang ada di form
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            // Hapus gambar lama jika ada
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Simpan gambar baru
            $fileName = time() . '_' . $request->file('profile_picture')->getClientOriginalName();
            $filePath = $request->file('profile_picture')->storeAs('profile_pictures', $fileName, 'public');
            $validatedData['profile_picture'] = $filePath;
        }

        $user->update($validatedData);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}