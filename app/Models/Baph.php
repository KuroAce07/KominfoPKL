<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Baph extends Model
{
    protected $table = 'baphs';
    protected $fillable = ['nomor', 'tanggal', 'keterangan', 'upload_dokumen'];

    public function dpa()
    {
        return $this->belongsTo(DPA::class, 'dpa_id');
    }
}