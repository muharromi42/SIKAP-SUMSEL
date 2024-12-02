<?php

namespace App\Http\Controllers;

use App\Models\BerkasModel;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $uploads = BerkasModel::with('user')->latest()->get();
        return view('admin.uploads.index', compact('uploads'));
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
}
