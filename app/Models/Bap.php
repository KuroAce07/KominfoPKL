<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bap extends Model
{
    protected $table = 'baps';
    protected $fillable = ['nomor', 'tanggal', 'keterangan', 'upload_dokumen'];

    public function dpa()
    {
        return $this->belongsTo(DPA::class, 'dpa_id');
    }
}
