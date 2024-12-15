<?php

namespace App\Http\Controllers;

use App\Models\BerkasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf; // Tambahkan alias ini

class AdminController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.uploads.index');
    }

    public function approved(Request $request)
    {
        if ($request->ajax()) {
            $query_data = BerkasModel::where('status', 'approved')->get();
            return DataTables::of($query_data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $showButton = '<a href="' . route('admin.uploads.show', $row->id) . '" class="btn btn-primary">Lihat</a>';
                    $deleteButton = '<form action="' . route('admin.uploads.destroy', $row->id) . '" method="POST" style="display:inline;" class="delete-form">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger delete-button">Delete</button></form>';
                    return $showButton . ' ' . $deleteButton;
                })
                ->addColumn('status', function ($row) {
                    return '<div class="card"><div class="card-body"><span class="badge bg-success">Disetujui</span></div></div>';
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('admin.uploads.approved');
    }

    public function rejected(Request $request)
    {
        if ($request->ajax()) {
            $query_data = BerkasModel::where('status', 'rejected')->get();
            return DataTables::of($query_data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $showButton = '<a href="' . route('admin.uploads.show', $row->id) . '" class="btn btn-primary">Lihat</a>';
                    $deleteButton = '<form action="' . route('admin.uploads.destroy', $row->id) . '" method="POST" style="display:inline;" class="delete-form">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger delete-button">Delete</button></form>';
                    return $showButton . ' ' . $deleteButton;
                })
                ->addColumn('status', function ($row) {
                    return '<div class="card"><div class="card-body"><span class="badge bg-danger">Ditolak</span></div></div>';
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('admin.uploads.rejected');
    }

    public function pending(Request $request)
    {
        if ($request->ajax()) {
            $query_data = BerkasModel::where('status', 'pending')->get();
            return DataTables::of($query_data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $showButton = '<a href="' . route('admin.uploads.show', $row->id) . '" class="btn btn-primary">Lihat</a>';
                    $deleteButton = '<form action="' . route('admin.uploads.destroy', $row->id) . '" method="POST" style="display:inline;" class="delete-form">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger delete-button">Delete</button></form>';
                    return $showButton . ' ' . $deleteButton;
                })
                ->addColumn('status', function ($row) {
                    return '<div class="card"><div class="card-body"><span class="badge bg-warning">Menunggu</span></div></div>';
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('admin.uploads.pending');
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
        return redirect()->back()->with('success', 'Data dan berkas berhasil dihapus.');
    }

    public function approvedPdf()
    {
        // Ambil data yang disetujui
        $query_data = BerkasModel::where('status', 'approved')->get();

        // Buat view untuk PDF
        $pdf = Pdf::loadView('admin.uploads.pdf_approved', compact('query_data'));

        // Return PDF ke browser atau download
        return $pdf->stream('approved-data.pdf'); // Untuk ditampilkan di browser
        // return $pdf->download('approved-data.pdf'); // Untuk langsung diunduh
    }
}
