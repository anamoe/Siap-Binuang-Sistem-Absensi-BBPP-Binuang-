<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatTrackingPegawai extends Model
{
    use HasFactory;
    protected $fillable = ['id_user','latitude','longitude','jam_kerja'];

      public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
