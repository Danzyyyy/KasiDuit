<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('donations', function (Blueprint $table) {
        $table->id();

        // Relasi
        $table->foreignId('campaign_id')->constrained()->onDelete('cascade');
        // User ID boleh kosong jika donatur tidak login (Guest)
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');

        // Data Unik Transaksi
        $table->string('order_id')->unique(); // ID unik untuk Payment Gateway
        
        // Data Donatur (Snapshot)
        $table->string('donor_name'); 
        $table->string('donor_email');
        $table->boolean('is_anonymous')->default(false); // Fitur "Hamba Allah"
        $table->text('comment')->nullable(); // Doa/Dukungan

        // Pembayaran
        $table->decimal('amount', 15, 2);
        $table->enum('status', ['pending', 'paid', 'cancelled'])->default('pending');
        $table->string('snap_token')->nullable(); // Khusus Midtrans (jika pakai)

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
