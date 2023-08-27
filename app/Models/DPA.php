<?php

namespace App\Models;

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

    public function subDpa()
    {
        return $this->hasMany(SubDPA::class, 'dpa_id');
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pejabatPengadaanUser()
    {
        return $this->belongsTo(User::class, 'user_id2');
    }

    public function pembantupptkUsers()
    {
        return $this->belongsTo(User::class, 'user_id3');
    }

    public function bendaharaUsers()
    {
        return $this->belongsTo(User::class, 'user_id4');
    }

    public function dokumenKontraks()
    {
        return $this->hasMany(DokumenKontrak::class, 'dpa_id');
    }

    public function dokumenJustifikasis()
    {
        return $this->hasMany(DokumenJustifikasi::class, 'dpa_id');
    }

    public function epurchasings()
    {
        return $this->hasMany(EPurchasing::class, 'dpa_id');
    }
    
    public function dokumenPendukungs()
    {
        return $this->hasMany(DokumenPendukung::class, 'dpa_id');
    }
    
    public function basts()
    {
        return $this->hasMany(Bast::class, 'dpa_id');
    }

    public function bap()
    {
        return $this->hasMany(Bap::class, 'dpa_id');
    }

    public function baph()
    {
        return $this->hasMany(Baph::class, 'dpa_id');
    }

    public function pilihrekanan()
    {
        return $this->hasMany(PilihRekanan::class, 'dpa_id');
    }
}
