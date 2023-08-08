<?php

namespace App\Models;

use App\Models\SubDPA;
use Illuminate\Database\Eloquent\Model;

class DPA extends Model
{
    protected $table = 'dpa';
    protected $fillable = [
        'nomor_dpa',
        'urusan_pemerintahan',
        'bidang_urusan',
        'program',
        'kegiatan',
        'dana',
    ];

    public function SubDpa()
    {
        return $this->hasMany(SubDPA::class, 'dpa_id');
    }
}