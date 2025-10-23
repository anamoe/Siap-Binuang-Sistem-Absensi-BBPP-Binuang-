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
        Schema::create('riwayat_tracking_pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('id_user');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('jam_kerja');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_tracking_pegawais');
    }
};
