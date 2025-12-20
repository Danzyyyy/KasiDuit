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
    Schema::create('campaigns', function (Blueprint $table) {
        $table->id();
        
        // Relasi (Foreign Keys)
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('category_id')->constrained()->onDelete('cascade');

        // Data Campaign
        $table->string('title');
        $table->string('slug')->unique();
        $table->string('short_description')->nullable();
        $table->text('full_description'); // Bisa simpan HTML dari text editor
        $table->string('image_path'); // Gambar utama

        // Keuangan (15 digit, 2 desimal)
        $table->decimal('target_amount', 15, 2);
        $table->decimal('collected_amount', 15, 2)->default(0);

        // Status & Waktu
        $table->date('deadline');
        $table->enum('status', ['pending', 'active', 'finished', 'rejected'])->default('pending');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
