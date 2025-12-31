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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained();
            
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('full_description');
            $table->string('image_path');
            
            $table->decimal('target_amount', 15, 2);
            $table->decimal('collected_amount', 15, 2)->default(0);
            $table->date('deadline');
            
            $table->string('organizer_name')->nullable();
            $table->string('organizer_phone')->nullable();

            // Data Wilayah
            $table->char('province_code', 2)->nullable();
            $table->string('province_name')->nullable();
            $table->char('regency_code', 5)->nullable();
            $table->string('regency_name')->nullable();
            $table->char('district_code', 8)->nullable();
            $table->string('district_name')->nullable();
            $table->char('village_code', 13)->nullable();
            $table->string('village_name')->nullable();

            $table->enum('status', ['pending', 'active', 'rejected', 'finished'])->default('pending');
            
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