<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResignApprover extends Model
{
    use HasFactory;

    public function role() {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
}
