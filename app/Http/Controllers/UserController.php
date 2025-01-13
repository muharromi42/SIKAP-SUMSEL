<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query_data = new User();
            $data = $query_data::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editButton = '<button class="btn btn-primary edit-button" data-id="' . $row->id . '">Edit</button>';
                    $deleteButton = '
                <form action="' . route('users.destroy', $row->id) . '" method="POST" style="display:inline;" class="delete-form">
                    ' . csrf_field() . method_field('DELETE') . '
                    <button type="submit" class="btn btn-danger delete-button">Delete</button>
                </form>';
                    return $editButton . ' ' . $deleteButton;
                })
                ->rawColumns(['action'])->make(true);
        }
        return view('users.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email', // Pastikan email unik
            'nip' => 'required|string|max:255|unique:users,nip', // Pastikan NIP unik
            'level' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'password' => 'required|string|min:8', // Pastikan password diisi dan konfirmasi cocok
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'nip' => $request->nip,
            'level' => $request->level,
            'status' => $request->status,
            'password' => Hash::make($request->password), // Enkripsi password
        ]);

        return redirect()->back()->with('success', 'User berhasil ditambahkan');
    }

    // public function edit(string $id)
    // {
    //     $user = User::findOrFail($id);
    //     // return response()->json($jenis_barang);
    //     return view('users.edit', compact('user'));
    // }
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function edit(User $user)
    {
        // Mengembalikan data pengguna dalam bentuk JSON
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nip' => 'nullable|string|max:20',
            'level' => 'required|in:user,admin',
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        $user = User::findOrFail($id);
        $user->nama = $request->input('nama');
        $user->email = $request->input('email');
        $user->nip = $request->input('nip');
        $user->level = $request->input('level');
        $user->status = $request->input('status');
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'data user berhasil di hapus');
    }

    public function usersend(Request $request)
    {
        if ($request->ajax()) {
            $data = User::has('berkas')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return '<div class="card"><div class="card-body"><span class="badge bg-success">Dikirim</span></div></div>';
                })
                ->rawColumns(['status'])->make(true);
        }
        return view('users.send');
    }

    public function usernotsend(Request $request)
    {
        if ($request->ajax()) {
            $data = User::hasnot('berkas')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return '<div class="card"><div class="card-body"><span class="badge bg-success">Dikirim</span></div></div>';
                })
                ->rawColumns(['status'])->make(true);
        }
        return view('users.send');
    }

    public function approvedPdf(Request $request)
    {
        $query = User::where('status', 'approved');


        $query_data = $query->get();

        // $judul = $bulan && $tahun
        //     ? "Data yang Disetujui Bulan {$bulan} Tahun {$tahun}"
        //     : "Semua Data yang Disetujui";

        $judul = "Semua Laporan Dokumen TPP";

        // Buat view untuk PDF
        $pdf = Pdf::loadView('admin.uploads.pdf_approved', compact('query_data', 'judul'))->setPaper('a4', 'landscape');

        // Return PDF ke browser atau download
        return $pdf->stream('approved-data.pdf'); // Untuk ditampilkan di browser
    }
}
