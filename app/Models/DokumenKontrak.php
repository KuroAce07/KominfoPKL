<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenKontrak extends Model
{
    protected $table = 'dokumen_kontraks';

    protected $fillable = [
        'jenis_kontrak',
        'nama_kegiatan_transaksi',
        'tanggal_kontrak',
        'jumlah_uang',
        'ppn',
        'pph',
        'jumlah_potongan',
        'jumlah_total',
        'keterangan',
        'upload_dokumen',
    ];

    public function dpa()
    {
        return $this->belongsTo(DPA::class, 'dpa_id');
    }
    
}
