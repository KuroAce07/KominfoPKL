<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenJustifikasi extends Model
{
    protected $table = 'dokumen_justifikasi';
    protected $fillable = ['nama', 'tanggal', 'keterangan', 'upload_dokumen'];

    public function dpa()
    {
        return $this->belongsTo(DPA::class, 'dpa_id');
    }
}
