<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

// 1. Import Namespace PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ForgotPassword extends Component
{
    public $email;
    public $otp;
    public $password;
    public $password_confirmation;
    
    public $step = 1; 

    public function sendOtp()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'Email ini tidak terdaftar.'
        ]);

        $otpCode = rand(100000, 999999);

        // Simpan token ke database (Tetap diperlukan untuk validasi nanti)
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $this->email],
            [
                'token' => $otpCode,
                'created_at' => Carbon::now()
            ]
        );

        // --- 2. LOGIKA PHPMAILER DIMULAI DI SINI ---
        $mail = new PHPMailer(true);

        try {
            // Konfigurasi Server (Ambil dari .env)
            $mail->isSMTP();
            $mail->Host       = env('MAIL_HOST', 'smtp.gmail.com');
            $mail->SMTPAuth   = true;
            $mail->Username   = env('MAIL_USERNAME'); // Email pengirim
            $mail->Password   = env('MAIL_PASSWORD'); // App Password (jika pakai Gmail)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Sesuaikan dengan env (tls/ssl)
            $mail->Port       = env('MAIL_PORT', 587);

            // Penerima
            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $mail->addAddress($this->email); // Email tujuan (input user)

            // Konten Email
            $mail->isHTML(true);
            $mail->Subject = 'Kode OTP Reset Password';
            $mail->Body    = "
                <h3>Permintaan Reset Password</h3>
                <p>Gunakan kode OTP berikut untuk mereset password Anda:</p>
                <h2 style='color: red;'>{$otpCode}</h2>
                <p>Kode ini berlaku selama 15 menit.</p>
            ";

            $mail->send();

            // Jika berhasil kirim, lanjut ke step 2
            $this->step = 2;
            session()->flash('success', 'Kode OTP telah dikirim ke email Anda via PHPMailer.');

        } catch (Exception $e) {
            // Jika gagal kirim
            $this->addError('email', 'Gagal mengirim email: ' . $mail->ErrorInfo);
        }
    }

    // Logic resetPassword tetap SAMA persis seperti sebelumnya
    public function resetPassword()
    {
        $this->validate([
            'otp' => 'required|numeric',
            'password' => 'required|min:8|confirmed',
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('email', $this->email)
            ->where('token', $this->otp)
            ->first();

        if (!$record) {
            $this->addError('otp', 'Kode OTP salah.');
            return;
        }

        if (Carbon::parse($record->created_at)->addMinutes(15)->isPast()) {
            $this->addError('otp', 'Kode OTP sudah kadaluarsa.');
            $this->step = 1;
            return;
        }

        User::where('email', $this->email)->update([
            'password' => Hash::make($this->password)
        ]);

        DB::table('password_reset_tokens')->where('email', $this->email)->delete();

        return redirect()->route('login')->with('success', 'Password berhasil diubah! Silakan login.');
    }

    public function render()
    {
        return view('auth.forgot_password');
    }
}