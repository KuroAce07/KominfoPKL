<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EPurchasing extends Model
{
    use HasFactory;

    protected $fillable = [
        'e_commerce',
        'id_paket',
        'jumlah',
        'harga_total',
        'tanggal_buat',
        'tanggal_ubah',
        'nama_pejabat_pengadaan',
        'nama_penyedia',
    ];

    public function dpa()
    {
        return $this->belongsTo(DPA::class, 'dpa_id');
    }
}

