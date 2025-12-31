<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

// Import Namespace PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

#[Layout('components.layouts.app')]
#[Title('Lupa Password - KasiDuit')]
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

        // Simpan token ke database
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $this->email],
            [
                'token' => $otpCode,
                'created_at' => Carbon::now()
            ]
        );

        // --- KIRIM EMAIL VIA PHPMAILER ---
        $mail = new PHPMailer(true);

        try {
            // Konfigurasi Server (Ambil dari .env)
            $mail->isSMTP();
            $mail->Host       = env('MAIL_HOST', 'smtp.gmail.com');
            $mail->SMTPAuth   = true;
            $mail->Username   = env('MAIL_USERNAME');
            $mail->Password   = env('MAIL_PASSWORD');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = env('MAIL_PORT', 587);

            // Pengirim & Penerima
            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $mail->addAddress($this->email);

            // Konten Email
            $mail->isHTML(true);
            $mail->Subject = 'Kode OTP Reset Password - KasiDuit';
            $mail->Body    = "
                <div style='font-family: Arial, sans-serif; padding: 20px; color: #333;'>
                    <h3 style='color: #dc2626;'>Permintaan Reset Password</h3>
                    <p>Kami menerima permintaan untuk mereset password akun KasiDuit Anda. Gunakan kode OTP berikut:</p>
                    <div style='background: #f3f4f6; padding: 15px; border-radius: 8px; text-align: center; margin: 20px 0;'>
                        <h1 style='color: #dc2626; letter-spacing: 5px; margin: 0;'>{$otpCode}</h1>
                    </div>
                    <p>Kode ini berlaku selama 15 menit. Jangan berikan kode ini kepada siapapun.</p>
                </div>
            ";

            $mail->send();

            $this->step = 2;
            session()->flash('success', 'Kode OTP telah dikirim ke email Anda via PHPMailer.');

        } catch (Exception $e) {
            $this->addError('email', 'Gagal mengirim email: ' . $mail->ErrorInfo);
        }
    }

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
        return view('livewire.auth.forgot_password');
    }
}