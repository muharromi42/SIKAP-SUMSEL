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

        // Ambil data nama_instansi yang unik
        $instansi_list = BerkasModel::select('nama_instansi')->distinct()->pluck('nama_instansi');


        return view('admin.uploads.approved', compact('instansi_list'));
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

        // Ambil data nama_instansi yang unik
        $instansi_list = BerkasModel::select('nama_instansi')->distinct()->pluck('nama_instansi');

        return view('admin.uploads.rejected', compact('instansi_list'));
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
        // Ambil data nama_instansi yang unik
        $instansi_list = BerkasModel::select('nama_instansi')->distinct()->pluck('nama_instansi');

        return view('admin.uploads.pending', compact('instansi_list'));
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
            'note' => 'nullable|string',
        ]);

        // Update status
        $upload->status = $request->status;
        $upload->note = $request->note;
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

    public function approvedPdf(Request $request)
    {

        // Ambil filter dari request
        $instansi = $request->input('instansi');
        $kabupaten = $request->input('kabupaten');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        // Ambil data yang disetujui
        // Query data dengan filter bulan dan tahun
        $query = BerkasModel::where('status', 'approved');

        if ($instansi) {
            $query->where('nama_instansi', $instansi);
        }

        if ($kabupaten) {
            $query->where('kabupaten', $kabupaten);
        }

        if ($bulan) {
            $query->where('bulan', $bulan);
        }

        if ($tahun) {
            $query->where('tahun', $tahun);
        }

        $query_data = $query->get();

        // $judul = $bulan && $tahun
        //     ? "Data yang Disetujui Bulan {$bulan} Tahun {$tahun}"
        //     : "Semua Data yang Disetujui";

        if ($bulan && $tahun) {
            $judul = "Laporan Dokumen TPP bulan {$bulan} Tahun {$tahun}";
        } elseif ($bulan) {
            $judul = "Laporan Dokumen TPP bulan {$bulan}";
        } elseif ($tahun) {
            $judul = "Laporan Dokumen TPP tahun {$tahun}";
        } else {
            $judul = "Semua Laporan Dokumen TPP";
        }
        // Buat view untuk PDF
        $pdf = Pdf::loadView('admin.uploads.pdf_approved', compact('query_data', 'judul'))->setPaper('a4', 'landscape');

        // Return PDF ke browser atau download
        return $pdf->stream('approved-data.pdf'); // Untuk ditampilkan di browser
    }

    public function rejectedPdf(Request $request)
    {

        // Ambil filter dari request
        $instansi = $request->input('instansi');
        $kabupaten = $request->input('kabupaten');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        // Ambil data yang disetujui
        // Query data dengan filter bulan dan tahun
        $query = BerkasModel::where('status', 'rejected');

        if ($instansi) {
            $query->where('nama_instansi', $instansi);
        }

        if ($kabupaten) {
            $query->where('kabupaten', $kabupaten);
        }

        if ($bulan) {
            $query->where('bulan', $bulan);
        }

        if ($tahun) {
            $query->where('tahun', $tahun);
        }

        $query_data = $query->get();

        // $judul = $bulan && $tahun
        //     ? "Data yang Disetujui Bulan {$bulan} Tahun {$tahun}"
        //     : "Semua Data yang Disetujui";

        if ($bulan && $tahun) {
            $judul = "Laporan Dokumen Ditolak TPP bulan {$bulan} Tahun {$tahun}";
        } elseif ($bulan) {
            $judul = "Laporan Dokumen Ditolak TPP bulan {$bulan}";
        } elseif ($tahun) {
            $judul = "Laporan Dokumen Ditolak TPP tahun {$tahun}";
        } else {
            $judul = "Semua Laporan Dokumen Ditolak TPP";
        }
        // Buat view untuk PDF
        $pdf = Pdf::loadView('admin.uploads.pdf_approved', compact('query_data', 'judul'))->setPaper('a4', 'landscape');

        // Return PDF ke browser atau download
        return $pdf->stream('approved-data.pdf'); // Untuk ditampilkan di browser
    }

    public function pendingPdf(Request $request)
    {

        // Ambil filter dari request
        $instansi = $request->input('instansi');
        $kabupaten = $request->input('kabupaten');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        // Ambil data yang disetujui
        // Query data dengan filter bulan dan tahun
        $query = BerkasModel::where('status', 'pending');

        if ($instansi) {
            $query->where('nama_instansi', $instansi);
        }

        if ($kabupaten) {
            $query->where('kabupaten', $kabupaten);
        }

        if ($bulan) {
            $query->where('bulan', $bulan);
        }

        if ($tahun) {
            $query->where('tahun', $tahun);
        }

        $query_data = $query->get();

        // $judul = $bulan && $tahun
        //     ? "Data yang Disetujui Bulan {$bulan} Tahun {$tahun}"
        //     : "Semua Data yang Disetujui";

        if ($bulan && $tahun) {
            $judul = "Laporan Dokumen Pending TPP bulan {$bulan} Tahun {$tahun}";
        } elseif ($bulan) {
            $judul = "Laporan Dokumen Pending TPP bulan {$bulan}";
        } elseif ($tahun) {
            $judul = "Laporan Dokumen Pending TPP tahun {$tahun}";
        } else {
            $judul = "Semua Laporan Dokumen Pending TPP";
        }
        // Buat view untuk PDF
        $pdf = Pdf::loadView('admin.uploads.pdf_approved', compact('query_data', 'judul'))->setPaper('a4', 'landscape');

        // Return PDF ke browser atau download
        return $pdf->stream('approved-data.pdf'); // Untuk ditampilkan di browser
    }
}
