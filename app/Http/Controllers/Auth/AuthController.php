<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function registration()
    {
        return view('auth.registration');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'nip' => 'required|unique:users,nip',
            'password' => 'required|min:8', // Password harus dikonfirmasi
        ]);
        // Tambahkan nilai default secara manual
        $validatedData['level'] = 'user';
        $validatedData['status'] = true; // true untuk aktif
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        // Set flash message untuk SweetAlert
        session()->flash('success', 'User registered successfully!');

        // Redirect ke login
        return redirect()->route('login');
    }


    public function logout()
    {
        // Session::flush();
        // Auth::logout();

        return Redirect('login');
    }
}
