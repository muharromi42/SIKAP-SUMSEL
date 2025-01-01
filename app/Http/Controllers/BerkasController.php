<?php

namespace App\Http\Controllers;

use App\Models\BerkasModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class BerkasController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query_data = BerkasModel::where('user_id', auth()->id())->get(); // Hanya ambil data yang terkait dengan user yang login
            return DataTables::of($query_data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $showButton = '<a href="' . route('uploads.edit', $row->id) . '" class="btn btn-primary">Lihat</a>';
                    $deleteButton = '<form action="' . route('uploads.destroy', $row->id) . '" method="POST" style="display:inline;" class="delete-form">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger delete-button">Delete</button></form>';
                    if ($row->status == 'rejected') {
                        return $showButton . ' ' . $deleteButton;
                    }
                })
                ->addColumn('status', function ($row) {
                    // Menambahkan card untuk status
                    if ($row->status == 'approved') {
                        return '<div class="card"><div class="card-body"><span class="badge bg-success">Disetujui</span></div></div>';
                    } elseif ($row->status == 'rejected') {
                        return '<div class="card"><div class="card-body"><span class="badge bg-danger">Ditolak</span></div></div>';
                    } else {
                        return '<div class="card"><div class="card-body"><span class="badge bg-warning">Menunggu</span></div></div>';
                    }
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('berkas.index');
    }

    public function pending(Request $request)
    {
        if ($request->ajax()) {
            $query_data = BerkasModel::where([
                ['user_id', '=', auth()->id()],
                ['status', '=', 'pending']
            ])->get();
            return DataTables::of($query_data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return '<div class="card"><div class="card-body"><span class="badge bg-warning">Menunggu</span></div></div>';
                })
                ->rawColumns(['status'])
                ->make(true);
        }

        return view('berkas.pending');
    }

    public function approved(Request $request)
    {
        if ($request->ajax()) {
            $query_data = BerkasModel::where([
                ['user_id', '=', auth()->id()],
                ['status', '=', 'approved']
            ])->get();
            return DataTables::of($query_data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return '<div class="card"><div class="card-body"><span class="badge bg-success">Disetujui</span></div></div>';
                })
                ->rawColumns(['status'])
                ->make(true);
        }

        return view('berkas.approved');
    }

    public function rejected(Request $request)
    {
        if ($request->ajax()) {
            $query_data = BerkasModel::where([
                ['user_id', '=', auth()->id()],
                ['status', '=', 'rejected']
            ])->get();
            return DataTables::of($query_data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $showButton = '<a href="' . route('uploads.edit', $row->id) . '" class="btn btn-primary">Lihat</a>';
                    $deleteButton = '<form action="' . route('uploads.destroy', $row->id) . '" method="POST" style="display:inline;" class="delete-form">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger delete-button">Delete</button></form>';
                    return $showButton . ' ' . $deleteButton;
                })
                ->addColumn('status', function ($row) {
                    return '<div class="card"><div class="card-body"><span class="badge bg-danger">Ditolak</span></div></div>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('berkas.rejected');
    }


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
            'npsn_sekolah' => 'nullable|string',
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
            'kabupaten' => $user->kabupaten,
            'nama_instansi' => $user->nama_instansi,
            'npsn_sekolah' => $request->npsn_sekolah,
            'file_sptjm' => $request->file('file_sptjm')->store('uploads', 'public'),
            'file_skp' => $request->file('file_skp')->store('uploads', 'public'),
            'file_tpp' => $request->file('file_tpp')->store('uploads', 'public'),
            'file_dhbpo' => $request->file('file_dhbpo')->store('uploads', 'public'),
            'file_ekinerja' => $request->file('file_ekinerja')->store('uploads', 'public'),
        ]);

        return redirect()->route('uploads.create')->with('success', 'Berkas berhasil diunggah!');
    }

    public function edit($id)
    {
        $berkas = BerkasModel::findOrFail($id);
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

        return view('berkas.edit', compact('berkas', 'kabupatenOptions'));
    }

    public function update(Request $request, $id)
    {
        $berkas = BerkasModel::findOrFail($id);

        // Validasi input
        $request->validate([
            'tahun' => 'required|integer',
            'bulan' => 'required|string',
            'kabupaten' => 'required|string',
            'npsn_sekolah' => 'nullable|string',
            'nama_instansi' => 'required|string',
            'file_sptjm' => 'nullable|mimes:pdf|max:2048',
            'file_skp' => 'nullable|mimes:pdf|max:2048',
            'file_tpp' => 'nullable|mimes:pdf|max:2048',
            'file_dhbpo' => 'nullable|mimes:pdf|max:2048',
            'file_ekinerja' => 'nullable|mimes:pdf|max:2048',
        ]);


        // Update data
        $berkas->update([
            'tahun' => $request->tahun,
            'bulan' => $request->bulan,
            'kabupaten' => $request->kabupaten,
            'npsn_sekolah' => $request->npsn_sekolah,
            'nama_instansi' => $request->nama_instansi,
            'file_sptjm' => $request->file('file_sptjm') ? $request->file('file_sptjm')->store('uploads', 'public') : $berkas->file_sptjm,
            'file_skp' => $request->file('file_skp') ? $request->file('file_skp')->store('uploads', 'public') : $berkas->file_skp,
            'file_tpp' => $request->file('file_tpp') ? $request->file('file_tpp')->store('uploads', 'public') : $berkas->file_tpp,
            'file_dhbpo' => $request->file('file_dhbpo') ? $request->file('file_dhbpo')->store('uploads', 'public') : $berkas->file_dhbpo,
            'file_ekinerja' => $request->file('file_ekinerja') ? $request->file('file_ekinerja')->store('uploads', 'public') : $berkas->file_ekinerja,
            'status' => 'pending'
        ]);

        return redirect()->route('berkas.rejected')->with('success', 'Berkas berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Temukan data berdasarkan ID
        $upload = BerkasModel::findOrFail($id);

        // Daftar file yang ingin dihapus
        $files = [
            $upload->file_sptjm,
            $upload->file_skp,
            $upload->file_tpp,
            $upload->file_dhbpo,
            $upload->file_ekinerja,
        ];

        // Hapus file jika ditemukan di storage
        foreach ($files as $file) {
            if ($file && Storage::disk('public')->exists($file)) {
                Storage::disk('public')->delete($file);
            }
        }

        // Hapus data dari database
        $upload->delete();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Data dan berkas berhasil dihapus.');
    }
}
