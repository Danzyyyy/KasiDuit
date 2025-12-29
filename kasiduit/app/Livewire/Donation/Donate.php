<?php

namespace App\Livewire\Donation;

use Midtrans\Config;
use Midtrans\Snap;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Campaign; 
use App\Models\Donation; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

#[Layout('components.layouts.app')] 
#[Title('Donasi - KasiDuit')]
class Donate extends Component
{
    public $campaignId;
    public $campaign; 
    
    // Default Step 1
    public $step = 1; 

    public $nominal = 0;
    public $customNominal = '';
    
    // Payment Method tetap ada untuk menampung hasil callback Midtrans nanti
    public $paymentMethod = '-'; 
    
    public $isAnonymous = false;
    public $prayer = ''; 
    public $adminFee = 2000; 

    public $snapToken;
    public $createdDonationId = null;
    public $orderId;

    public function mount($id)
    {
        $this->campaignId = $id;
        $this->campaign = Campaign::findOrFail($id);
    }

    // --- STEP 1: NOMINAL ---
    public function setNominal($amount)
    {
        $this->nominal = $amount;
        $this->customNominal = ''; 
    }

    public function updatedCustomNominal()
    {
        if ($this->customNominal) {
            $this->nominal = (int) $this->customNominal;
        }
    }

    public function validateStep1()
    {
        if ($this->customNominal) {
            $this->nominal = (int) $this->customNominal;
        }

        if ($this->nominal < 10000) {
            session()->flash('error', 'Minimal donasi Rp 10.000');
            return;
        }
        
        // [UBAH]: Langsung ke Step 2 (Identitas), lewati pemilihan pembayaran
        $this->step = 2; 
    }

    // --- STEP 2: IDENTITAS (DULUNYA STEP 3) ---
    // Kita hapus fungsi selectPayment dan validateStep2 yang lama
    
    public function validateIdentity() 
    {
        // Validasi nama/email jika perlu, lalu lanjut ke Konfirmasi
        $this->step = 3; 
    }
    
    public function prevStep()
    {
        if ($this->step > 1) {
            $this->step--;
        } else {
            return redirect()->back();
        }
    }

    // --- STEP 3: KONFIRMASI & PROSES (DULUNYA STEP 4) ---
    public function processDonation()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $this->orderId = 'DON-' . strtoupper(Str::random(10));
        $totalAmount = $this->nominal + $this->adminFee;

        $params = [
            'transaction_details' => [
                'order_id' => $this->orderId,
                'gross_amount' => (int) $totalAmount,
            ],
            'customer_details' => [
                'first_name' => $this->isAnonymous ? 'Hamba Allah' : (Auth::user()->name ?? 'Guest'),
                'email' => Auth::user()->email ?? 'guest@kasiduit.com',
            ],
        ];

        try {
            $this->snapToken = Snap::getSnapToken($params);

            $donation = Donation::create([
                'campaign_id'   => $this->campaign->id,
                'user_id'       => Auth::id(),
                'order_id'      => $this->orderId,
                'donor_name'    => $this->isAnonymous ? 'Hamba Allah' : (Auth::user()->name ?? 'Guest'),
                'donor_email'   => Auth::user()->email ?? 'guest@kasiduit.com',
                'is_anonymous'  => $this->isAnonymous,
                'comment'       => $this->prayer,
                'amount'        => $this->nominal,
                'status'        => 'pending',      
                'snap_token'    => $this->snapToken,
            ]);
            
            $this->createdDonationId = $donation->id; 
            $this->dispatch('open-payment-popup', token: $this->snapToken);

        } catch (\Exception $e) {
            session()->flash('error', 'Gagal: ' . $e->getMessage());
        }
    }

    public function finishPayment($result = null)
    {
        // Default label jika gagal parsing
        $readableMethod = 'Payment Gateway'; 

        if ($result) {
            // Konversi ke array jika dikirim sebagai object (jaga-jaga)
            $data = (array) $result;
            
            $type = $data['payment_type'] ?? null;

            // --- LOGIKA PARSING NAMA PAYMENT ---
            if ($type == 'bank_transfer') {
                // Cek VA Numbers (BCA, BNI, BRI)
                if (isset($data['va_numbers'][0]['bank'])) {
                    $readableMethod = strtoupper($data['va_numbers'][0]['bank']) . ' Virtual Account';
                } 
                // Cek Permata
                elseif (isset($data['permata_va_number'])) {
                    $readableMethod = 'PERMATA Virtual Account';
                }
            } 
            elseif ($type == 'cstore') {
                $readableMethod = ucfirst($data['store'] ?? 'Minimarket');
            } 
            elseif ($type == 'qris' || $type == 'gopay') {
                $readableMethod = 'QRIS / E-Wallet';
            }
            elseif ($type == 'credit_card') {
                $readableMethod = 'Credit Card';
            }
            elseif ($type == 'echannel') {
                $readableMethod = 'Mandiri Bill Payment';
            }
        }

        // SIMPAN KE DATABASE LANGSUNG
        if ($this->createdDonationId) {
            $donation = Donation::find($this->createdDonationId);
            if ($donation) {
                $donation->update([
                    'payment_method' => $readableMethod
                ]);
            }
        }

        // Redirect ke halaman status
        return redirect()->route('donation.check', ['order_id' => $this->orderId]);
    }

    // ... method unfinishPayment & errorPayment sama ...
    public function render() { 
        return view('livewire.donation.donate'); 
    }
}