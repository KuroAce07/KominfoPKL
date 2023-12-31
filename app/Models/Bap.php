<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bap extends Model
{
    protected $table = 'baps';
    protected $fillable = ['nomor', 'tanggal', 'keterangan', 'upload_dokumen','approval', ];

    public function dpa()
    {
        return $this->belongsTo(DPA::class, 'dpa_id');
    }
}
