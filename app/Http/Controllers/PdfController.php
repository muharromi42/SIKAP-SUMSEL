<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function generateApprovedFilesPdf()
    {
        // Ambil data file yang telah disetujui
        $approvedFiles = UserFile::where('is_uploaded', true)->get();

        // Load view ke dalam PDF
        $pdf = PDF::loadView('pdf.approved_files', compact('approvedFiles'));

        // Kembalikan PDF untuk diunduh
        return $pdf->download('approved_files.pdf');
    }
}
