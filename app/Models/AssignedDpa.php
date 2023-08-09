<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignedDpa extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dpa()
    {
        return $this->belongsTo(Dpa::class);
    }
}
