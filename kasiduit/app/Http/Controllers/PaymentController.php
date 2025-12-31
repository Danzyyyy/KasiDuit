<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;
use App\Models\Donation;

class PaymentController extends Controller
{
    public function callback(Request $request)
    {
        // 1. Konfigurasi
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // 2. Baca Notifikasi
        try {
            $notif = new Notification();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Invalid notification'], 400);
        }

        // 3. Ambil Data
        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;

        // 4. Cari Donasi
        $donation = Donation::where('order_id', $order_id)->first();
        if (!$donation) {
            return response()->json(['message' => 'Donation not found'], 404);
        }

        $readableMethod = $type; 

        if ($type == 'bank_transfer') {
            if (isset($notif->va_numbers[0]->bank)) {
                $readableMethod = strtoupper($notif->va_numbers[0]->bank) . ' Virtual Account';
            } elseif (isset($notif->permata_va_number)) {
                $readableMethod = 'PERMATA Virtual Account';
            }
        } elseif ($type == 'cstore') {
            $readableMethod = ucfirst($notif->store ?? 'Minimarket');
        } elseif ($type == 'qris' || $type == 'gopay') {
            $readableMethod = 'QRIS / E-Wallet';
        } elseif ($type == 'echannel') {
            $readableMethod = 'Mandiri Bill Payment';
        }

        // Update payment_method tanpa mengubah status (jaga-jaga status masih pending)
        $donation->update(['payment_method' => $readableMethod]);
        // -------------------------------------------------------


        // 5. Tentukan Status Baru
        if ($donation->status == 'paid') {
            return response()->json(['message' => 'Already paid'], 200);
        }

        $newStatus = null;

        if ($transaction == 'capture' || $transaction == 'settlement') {
            $newStatus = 'paid';
        } elseif ($transaction == 'pending') {
            $newStatus = 'pending';
        } elseif ($transaction == 'deny' || $transaction == 'expire' || $transaction == 'cancel') {
            $newStatus = 'failed';
        }

        // 6. Update Database Status
        if ($newStatus) {
            $donation->update(['status' => $newStatus]);

            if ($newStatus == 'paid') {
                $donation->campaign->increment('collected_amount', $donation->amount);
            }
        }

        return response()->json(['message' => 'Donation status updated to: ' . $newStatus]);
    }
}