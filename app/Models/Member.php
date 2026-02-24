<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'name', 
        'phone',
        'username', // Añadir esto
        'email', 
        'fingerprint_hash', 
        'photo_path', 
        'status', 
        'membership_expires_at'
    ];

    // Relación: Un socio tiene muchos registros de acceso
    public function accessLogs()
    {
        return $this->hasMany(AccessLog::class);
    }
}
