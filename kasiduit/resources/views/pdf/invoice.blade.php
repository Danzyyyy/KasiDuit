<!DOCTYPE html>
<html>
<head>
    <title>Invoice Donasi - KasiDuit</title>
    <style>
        body { font-family: sans-serif; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #dc2626; padding-bottom: 20px; }
        .header h1 { color: #dc2626; margin: 0; }
        .header p { margin: 5px 0; font-size: 14px; color: #666; }
        
        .details { width: 100%; margin-bottom: 30px; }
        .details td { padding: 5px; vertical-align: top; }
        .label { font-weight: bold; width: 150px; }
        
        .box { background: #f9fafb; padding: 20px; border-radius: 8px; border: 1px solid #e5e7eb; }
        .amount { font-size: 24px; font-weight: bold; color: #dc2626; }
        
        .footer { margin-top: 50px; text-align: center; font-size: 12px; color: #999; }
        .badge { background: #dcfce7; color: #166534; padding: 5px 10px; border-radius: 15px; font-size: 12px; font-weight: bold; }
    </style>
</head>
<body>

    <div class="header">
        <h1>KasiDuit</h1>
        <p>Platform Donasi Terpercaya Indonesia</p>
        <p>Order ID: #{{ $donation->order_id }}</p>
    </div>

    <div class="box">
        <table class="details">
            <tr>
                <td class="label">Campaign:</td>
                <td>{{ $donation->campaign->title }}</td>
            </tr>
            <tr>
                <td class="label">Donatur:</td>
                <td>{{ $donation->is_anonymous ? 'Hamba Allah' : $donation->donor_name }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal:</td>
                <td>{{ $donation->created_at->format('d F Y, H:i') }}</td>
            </tr>
            <tr>
                <td class="label">Metode:</td>
                <td style="text-transform: uppercase;">{{ $donation->payment_method ?? 'Transfer' }}</td>
            </tr>
            <tr>
                <td class="label">Status:</td>
                <td><span class="badge">LUNAS (PAID)</span></td>
            </tr>
        </table>

        <hr style="border: 0; border-top: 1px dashed #ccc; margin: 20px 0;">

        <table style="width: 100%">
            <tr>
                <td><strong>Total Donasi</strong></td>
                <td style="text-align: right;" class="amount">Rp {{ number_format($donation->amount, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Terima kasih atas kebaikan Anda. Donasi ini telah tercatat secara sah di sistem kami.</p>
        <p>&copy; {{ date('Y') }} KasiDuit Foundation</p>
    </div>

</body>
</html>