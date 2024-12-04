<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\BerkasModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

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
        return back()->with([
            'status' => 'error',
            'message' => 'NIP atau password salah.'
        ])->withInput($request->only('nip'));
    }

    public function dashboard(Request $request)
    {
        // Mengambil jumlah berkas berdasarkan status
        $berkasCount = DB::table('berkas')
            ->select(DB::raw('status, count(*) as count'))
            ->groupBy('status')
            ->get();
        // Persiapkan data untuk chart
        $dataBerkas = [
            'pending' => 0,
            'approved' => 0,
            'rejected' => 0,
        ];

        // Isi data berdasarkan hasil query
        foreach ($berkasCount as $item) {
            $dataBerkas[$item->status] = $item->count;
        }

        $selectedYear = $request->get('year', date('Y')); // Default ke tahun saat ini
        $chartData = DB::table('berkas')
            ->select(DB::raw("kabupaten, bulan, COUNT(*) as total"))
            ->where('tahun', $selectedYear) // Gunakan kolom 'tahun'
            ->groupBy('kabupaten', 'bulan')
            ->orderBy('bulan')
            ->get();

        $kabupatenList = $chartData->pluck('kabupaten')->unique();
        $bulanList = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        // Format data untuk chart
        $formattedData = [];
        foreach ($kabupatenList as $kabupaten) {
            $data = [];
            foreach ($bulanList as $bulan) {
                $data[] = $chartData->where('kabupaten', $kabupaten)->where('bulan', $bulan)->sum('total') ?? 0;
            }
            $formattedData[] = [
                'name' => $kabupaten,
                'data' => $data
            ];
        }

        return view('dashboard.index', [
            'categories' => $bulanList,
            'series' => $formattedData,
            'selectedYear' => $selectedYear,
            'userCount' => User::count(),
            'berkasCount' => BerkasModel::count(),
            'approvedCount' => BerkasModel::where('status', 'approved')->count(),
            'rejectedCount' => BerkasModel::where('status', 'rejected')->count(),
            'dataBerkas' => $dataBerkas
        ]);
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
        $validatedData['status'] = 'aktif'; // true untuk aktif
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
