<?php

namespace Database\Seeders;

use App\Models\TimKerja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        TimKerja::create(['nama' => 'Keuangan']);
        TimKerja::create(['nama' => 'BMN dan Rumah Tangga']);
        TimKerja::create(['nama' => 'Pengelolaan SDM dan TU']);
        TimKerja::create(['nama' => 'Program dan Kerja Sama']);
        TimKerja::create(['nama' => 'Evaluasi dan Pelaporan']);
        TimKerja::create(['nama' => 'Pelatihan Aparatur dan Nonaparatur']);
        TimKerja::create(['nama' => 'Sertifikasi Profesi, Layanan Konsultasi dan PIA']);
        
    }
}
