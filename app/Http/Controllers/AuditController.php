<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Clegginabox\PDFMerger\PDFMerger;
use Illuminate\Support\Facades\Storage;

class AuditController extends Controller
{
    public function index()
    {
        $audits = Audit::all();
        return view('audit', ['audits' => $audits]);
    }

    public function generatePDF($id)
    {
        $audit = Audit::find($id);

        // Buat halaman kedua dari PDF
        $pdf = Pdf::loadView('pdf_template', [
            'title' => $audit->title,
            'date' => $audit->date,
            'description' => $audit->description,
        ]);
        $pdf->setPaper('a4');

        // Simpan halaman kedua ke file PDF sementara
        $secondPagePath = storage_path('app/public/temp_second_page.pdf');
        $pdf->save($secondPagePath);

        // Ambil halaman cover
        $firstPagePath = storage_path('app/public/cover.pdf');

        // Gabungkan halaman pertama dengan CV yang sudah diupload
        $finalPdf = new PDFMerger();
        $finalPdf->addPDF($firstPagePath, 'all');
        $finalPdf->addPDF($secondPagePath, 'all');

        // Simpan file PDF hasil gabungan
        $outputPath = storage_path('app/public/combined.pdf');
        $finalPdf->merge('file', $outputPath);

        // Kembalikan PDF hasil gabungan sebagai response download
        return response()->download($outputPath);
    }
}
