<?php

// database/migrations/2023_08_01_create_sub_d_p_a_s_table.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubDPA extends Model
{
    protected $table = 'sub_dpa'; // Specify the table name if it's different from the default naming convention
    // Other model configurations, if needed
    public function dpa()
    {
        return $this->belongsTo(DPA::class, 'dpa_id');
    }
}
