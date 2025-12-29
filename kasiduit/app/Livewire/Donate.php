<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Campaign; // 1. Import Model Campaign
use App\Models\Donation; // 2. Import Model Donation
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

#[Layout('components.layouts.app')] 
#[Title('Donasi - KasiDuit')]
class Donate extends Component
{
    public $campaignId;
    public $campaign; // Ini sekarang akan berisi Object Model, bukan array dummy
    
    public $step = 1; 

    // Data Form
    public $nominal = 0;
    public $customNominal = '';
    public $paymentMethod = '';
    public $isAnonymous = false;
    public $prayer = ''; 
    public $adminFee = 2000; 

    public function mount($id)
    {
        $this->campaignId = $id;
        // 3. Ambil data asli dari database agar bisa diupdate
        $this->campaign = Campaign::findOrFail($id);
    }

    // --- LOGIC STEP 1: NOMINAL ---
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
        
        $this->step = 2;
    }

    // --- LOGIC STEP 2: PEMBAYARAN ---
    public function selectPayment($method)
    {
        $this->paymentMethod = $method;
    }

    public function validateStep2()
    {
        if (!$this->paymentMethod) {
            session()->flash('error', 'Silakan pilih metode pembayaran.');
            return;
        }
        $this->step = 3;
    }

    // --- LOGIC STEP 3: IDENTITAS ---
    public function validateStep3()
    {
        $this->step = 4;
    }

    // --- LOGIC STEP 4: PROSES BAYAR ---
    public function processDonation()
    {
        // 4. Simpan ke Database 'donations'
        Donation::create([
            'campaign_id'   => $this->campaign->id,
            'user_id'       => Auth::id(), // ID User jika login, null jika tamu
            'order_id'      => 'DON-' . strtoupper(Str::random(10)), // ID Transaksi Unik
            'donor_name'    => $this->isAnonymous ? 'Hamba Allah' : (Auth::user()->name ?? 'Guest'),
            'donor_email'   => Auth::user()->email ?? 'guest@kasiduit.com',
            'is_anonymous'  => $this->isAnonymous,
            'comment'       => $this->prayer,
            'amount'        => $this->nominal,
            'status'        => 'paid', // Langsung 'paid' (Simulasi berhasil)
        ]);
        
        // 5. Akumulasikan dana ke tabel 'campaigns'
        // Menambah nominal baru ke total yang sudah ada
        $this->campaign->increment('collected_amount', $this->nominal);

        // 6. Masuk ke Step 5 (Halaman Sukses)
        $this->step = 5; 
    }

    // Tombol Kembali
    public function prevStep()
    {
        if ($this->step > 1) {
            $this->step--;
        } else {
            return redirect()->back();
        }
    }

    public function render()
    {
        return view('livewire.donate');
    }
}