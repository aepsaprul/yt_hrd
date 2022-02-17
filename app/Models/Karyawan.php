<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    public function jabatan() {
        return $this->belongsTo(Jabatan::class, 'jabatan_id', 'id');
    }

    public function cabang() {
        return $this->belongsTo(Cabang::class, 'cabang_id', 'id');
    }
}
