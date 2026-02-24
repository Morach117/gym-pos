<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\AccessLog;
use Carbon\Carbon; // Librería de Laravel para manejar fechas fácilmente

class AccessController extends Controller
{
    public function validateAccess(Request $request)
    {
        // 1. C# nos enviará el hash de la huella a través de una petición POST
        $hash = $request->input('fingerprint_hash');

        // Buscamos al socio que tenga esa huella
        $member = Member::where('fingerprint_hash', $hash)->first();

        // Si no existe, rechazamos inmediatamente
        if (!$member) {
            return response()->json([
                'status' => 'error',
                'action' => 'deny',
                'message' => 'Huella no reconocida'
            ], 404);
        }

        // 2. Validar si está activo y si su membresía está vigente
        // Carbon revisa si la fecha de expiración ya pasó el día de hoy
        $isExpired = Carbon::parse($member->membership_expires_at)->isPast();

        if ($member->status !== 'active' || $isExpired) {
            
            // Registramos el intento fallido en el Dashboard
            AccessLog::create([
                'member_id' => $member->id,
                'result' => 'denied',
                'reason' => 'Membresía inactiva o vencida'
            ]);

            return response()->json([
                'status' => 'error',
                'action' => 'deny',
                'message' => 'Acceso denegado: Membresía vencida',
                'member_name' => $member->name
            ], 403);
        }

        // 3. Todo está en orden, concedemos el acceso
        AccessLog::create([
            'member_id' => $member->id,
            'result' => 'granted',
            'reason' => 'Acceso correcto'
        ]);

        return response()->json([
            'status' => 'success',
            'action' => 'grant', // Esta es la palabra clave que C# leerá para activar el Arduino
            'message' => 'Bienvenido',
            'member_name' => $member->name
        ], 200);
    }
}