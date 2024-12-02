<?php

namespace App\Http\Controllers;

use App\Models\BerkasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BerkasController extends Controller
{
    public function create()
    {
        $kabupatenOptions = [
            'Banyuasin',
            'Empat Lawang',
            'Lahat',
            'Lubuk Linggau',
            'Muara Enim',
            'Musi Banyuasin',
            'Musi Rawas',
            'Ogan Ilir',
            'Ogan Komering Ilir',
            'Ogan Komering Ulu',
            'Palembang',
            'Pagar Alam',
            'Prabumulih',
        ];

        return view('berkas.create', compact('kabupatenOptions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|integer',
            'bulan' => 'required|string',
            'kabupaten' => 'required|string',
            'npsn_sekolah' => 'nullable|string',
            'nama_instansi' => 'required|string',
            'file_sptjm' => 'required|mimes:pdf|max:2048',
            'file_skp' => 'required|mimes:pdf|max:2048',
            'file_tpp' => 'required|mimes:pdf|max:2048',
            'file_dhbpo' => 'required|mimes:pdf|max:2048',
            'file_ekinerja' => 'required|mimes:pdf|max:2048',
        ]);

        $user = Auth::user();

        $upload = BerkasModel::create([
            'user_id' => $user->id,
            'nama_user' => $user->nama,
            'nip' => $user->nip,
            'tahun' => $request->tahun,
            'bulan' => $request->bulan,
            'kabupaten' => $request->kabupaten,
            'npsn_sekolah' => $request->npsn_sekolah,
            'nama_instansi' => $request->nama_instansi,
            'file_sptjm' => $request->file('file_sptjm')->store('uploads', 'public'),
            'file_skp' => $request->file('file_skp')->store('uploads', 'public'),
            'file_tpp' => $request->file('file_tpp')->store('uploads', 'public'),
            'file_dhbpo' => $request->file('file_dhbpo')->store('uploads', 'public'),
            'file_ekinerja' => $request->file('file_ekinerja')->store('uploads', 'public'),
        ]);

        return redirect()->route('uploads.create')->with('success', 'Berkas berhasil diunggah!');
    }
}
