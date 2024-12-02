<?php

namespace App\Http\Controllers;

use App\Models\BerkasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query_data = BerkasModel::all(); // Tidak perlu 'new' dan ':all()'
            return DataTables::of($query_data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // Tombol Lihat
                    $showButton = '<a href="' . route('admin.uploads.show', $row->id) . '" class="btn btn-primary">Lihat</a>';

                    // Tombol Delete
                    $deleteButton = '
                    <form action="' . route('admin.uploads.destroy', $row->id) . '" method="POST" style="display:inline;" class="delete-form">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger delete-button">Delete</button>
                    </form>';

                    // Gabungkan tombol Lihat dan Delete
                    return $showButton . ' ' . $deleteButton;
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
                ->rawColumns(['action', 'status']) // Pastikan kolom status dan action menerima HTML
                ->make(true);
        }
        return view('admin.uploads.index');
    }


    public function show($id)
    {
        $upload = BerkasModel::with('user')->findOrFail($id);
        return view('admin.uploads.show', compact('upload'));
    }

    public function validateUpload(Request $request, $id)
    {
        $upload = BerkasModel::findOrFail($id);

        // Validasi input status
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        // Update status
        $upload->status = $request->status;
        $upload->save();

        return redirect()->back()->with('success', 'Berkas telah divalidasi.');
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
        return redirect()->route('admin.uploads.index')->with('success', 'Data dan berkas berhasil dihapus.');
    }
}
