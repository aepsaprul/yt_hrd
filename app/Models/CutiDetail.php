<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CutiDetail extends Model
{
    use HasFactory;

    public function cuti() {
        return $this->belongsTo(Cuti::class, 'cuti_id', 'id');
    }
}
