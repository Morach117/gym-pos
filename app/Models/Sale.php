<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['member_id', 'total', 'payment_method'];

    // Relación: La venta pertenece a un socio (opcional)
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}