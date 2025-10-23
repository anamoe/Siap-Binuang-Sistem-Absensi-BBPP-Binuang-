<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bmn extends Model
{
    protected $fillable = [
        'jenis_bmn',
        'kode_satker',
        'nama_satker',
        'kode_barang',
        'nup',
    ];
    use HasFactory;
}
