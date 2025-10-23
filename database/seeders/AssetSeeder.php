<?php

namespace Database\Seeders;

use App\Models\Aset;
use App\Models\TimKerja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tim1 = TimKerja::firstOrCreate(['nama' => 'Pengelolaan SDM dan Tata Usaha']);
        $tim2 = TimKerja::firstOrCreate(['nama' => 'Keuangan']);
        $tim3 = TimKerja::firstOrCreate(['nama' => 'Pelatihan Aparatur dan Nonaparatur']);
        $tim4 = TimKerja::firstOrCreate(['nama' => 'BMN dan Rumah Tangga']);


        Aset::create([
            'uuid' => (string) Str::uuid(),
            'nama' => 'Printer Canon IP2770S',
            'spesifikasi' => "Intel i5-1335U, RAM 16GB, SSD 512GB, Windows 11 Pro",
            'lokasi' => 'Ruang PIA',
            'timker_id' => $tim1->id,
            'status' => 'baik',
            'catatan' => 'Adaptor cadangan tersedia',
            'next_maintenance_date'=> now()
        ]);

        Aset::create([
            'uuid' => (string) Str::uuid(),
            'nama' => 'Printer Canon LBP6030',
            'spesifikasi' => "LaserJet, Resolusi 600 dpi",
            'lokasi' => 'Ruang Keuangan',
            'timker_id' => $tim2->id,
            'status' => 'hilang',
            'catatan' => 'Perlu diganti cartridge',
            'next_maintenance_date'=> now()

        ]);
        Aset::create([
            'uuid' => (string) Str::uuid(),
            'nama' => 'Camera DLSR',
            'spesifikasi' => "LaserJet, Resolusi 600 dpi",
            'lokasi' => 'Ruang Penyelenggaraan',
            'timker_id' => $tim3->id,
            'status' => 'dipinjam',
            'catatan' => '-',
            'next_maintenance_date'=> now()

        ]);
        Aset::create([
            'uuid' => (string) Str::uuid(),
            'nama' => 'LCD Proyektor ABC',
            'spesifikasi' => "Proyektor Canoon 2020",
            'lokasi' => 'Ruang BMN',
            'timker_id' => $tim4->id,
            'status' => 'baik',
            'catatan' => '-',
            'next_maintenance_date'=> now()

        ]);

         Aset::create([
            'uuid' => (string) Str::uuid(),
            'nama' => 'Alat Sprayer',
            'spesifikasi' => "20 ML Pegas Manual",
            'lokasi' => 'Bengekel ALSINTAN',
            'timker_id' => $tim4->id,
            'status' => 'baik',
            'catatan' => '-',
            'next_maintenance_date'=> now()

        ]);
    }
}
