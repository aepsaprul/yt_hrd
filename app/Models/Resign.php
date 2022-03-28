<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resign extends Model
{
    use HasFactory;

    public function karyawan() {
        return $this->belongsTo(Karyawan::class, 'karyawan_id', 'id');
    }

    public function approvedLeader() {
        return $this->belongsTo(Karyawan::class, 'approved_leader', 'id');
    }
}
