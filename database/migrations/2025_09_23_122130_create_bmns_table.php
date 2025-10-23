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
        Schema::create('bmns', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_bmn');
            $table->string('kode_satker');
            $table->string('nama_satker');
            $table->string('kode_barang');
            $table->string('nup');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bmns');
    }
};
