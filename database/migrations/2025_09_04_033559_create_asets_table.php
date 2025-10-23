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
        Schema::create('asets', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();      
            $table->string('nama');              
            $table->text('spesifikasi')->nullable();    
            $table->string('lokasi')->nullable(); 
            $table->foreignId('timker_id')->nullable()->constrained('tim_kerjas')->nullOnDelete();
            $table->enum('status', ['baik','rusak','dipinjam','hilang'])->default('baik'); 
            $table->string('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asets');
    }
};
