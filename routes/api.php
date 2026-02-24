<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// 1. Importamos nuestros controladores
use App\Http\Controllers\AccessController;
use App\Http\Controllers\POSController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// --- RUTAS DEL GIMNASIO ---

// Endpoint para el hardware del torniquete (C# enviará el POST aquí)
Route::post('/access/validate', [AccessController::class, 'validateAccess']);

// Endpoints para el Punto de Venta (POS)
Route::get('/pos/products', [POSController::class, 'getProducts']); // Para cargar el catálogo de productos
Route::post('/pos/sale', [POSController::class, 'processSale']);    // Para procesar el cobro