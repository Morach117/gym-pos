<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model
{
    protected $fillable = ['member_id', 'result', 'reason'];

    // Relación: Este registro pertenece a un socio
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}