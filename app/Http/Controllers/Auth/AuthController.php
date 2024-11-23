<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nip' => 'required',
            'password' => 'required',
        ]);

        // Cek kredensial menggunakan Auth
        if (Auth::attempt(['nip' => $credentials['nip'], 'password' => $credentials['password']])) {
            // Regenerate session
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        // Jika login gagal
        return back()->withErrors([
            'loginError' => 'NIP atau password salah.',
        ])->withInput($request->only('nip'));
    }

    public function dashboard()
    {
        return view('dashboard.index');
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


    // public function logout()
    // {
    //     Session::flush();
    //     Auth::logout();

    //     return Redirect('login');
    // }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
