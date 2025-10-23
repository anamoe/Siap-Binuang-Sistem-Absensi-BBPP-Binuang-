<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    use HasFactory;
     protected $fillable = [
        'uuid',
        'nama',
        'spesifikasi',
        'lokasi',
        'timker_id',
        'status',
        'catatan',
    ];

     public function team()
    {
        return $this->belongsTo(TimKerja::class,'timker_id');
    }
}
