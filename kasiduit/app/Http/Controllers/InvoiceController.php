<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function download($id)
    {
        $donation = Donation::with(['campaign', 'user'])->findOrFail($id);

        $pdf = Pdf::loadView('pdf.invoice', ['donation' => $donation]);

        return $pdf->download('invoice-' . $donation->order_id . '.pdf');
    }
}