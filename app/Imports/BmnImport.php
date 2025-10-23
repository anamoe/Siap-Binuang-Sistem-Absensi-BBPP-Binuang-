<?php

namespace App\Imports;

use App\Models\Bmn;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none'); // biar header Excel tidak otomatis diubah

class BmnImport implements ToModel, WithHeadingRow, SkipsEmptyRows
{
    /**
     * Jika header Excel Anda berada di baris pertama,
     * biarkan default = 1. Jika mulai di baris 2/3, ubah di sini.
     */
    public function headingRow(): int
    {
        return 1;
    }

    public function model(array $row)
    {
        // Validasi: jika kolom wajib kosong, baris dilewati
        if (empty($row['Jenis BMN'])) { // gunakan persis nama header Excel
            return null;
        }

        return new Bmn([
            'jenis_bmn'   => trim($row['Jenis BMN']),
            'kode_satker' => trim($row['Kode Satker']),
            'nama_satker' => trim($row['Nama Satker']),
            'kode_barang' => trim($row['Kode Barang']),
            'nup'         => trim($row['NUP']),
        ]);
    }
}
