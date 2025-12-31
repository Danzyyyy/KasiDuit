<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // Import PDF

class InvoiceController extends Controller
{
    public function download($id)
    {
        // Ambil data donasi
        $donation = Donation::with(['campaign', 'user'])->findOrFail($id);

        // Load View khusus PDF (kita buat di langkah 4)
        $pdf = Pdf::loadView('pdf.invoice', ['donation' => $donation]);

        // Download file dengan nama unik
        return $pdf->download('invoice-' . $donation->order_id . '.pdf');
    }
}