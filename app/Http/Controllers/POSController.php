<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB; // Lo usamos para proteger las transacciones

class POSController extends Controller
{
    // 1. Enviar los productos al Frontend (JavaScript los pedirá por Fetch)
    public function getProducts()
    {
        // Solo enviamos los productos que estén activos y tengan stock
        $products = Product::where('is_active', true)
                           ->where('stock', '>', 0)
                           ->get();
                           
        return response()->json($products);
    }

    // 2. Procesar el cobro en el Punto de Venta
    public function processSale(Request $request)
    {
        // Validamos que JavaScript nos envíe los datos correctamente estructurados
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'payment_method' => 'required|string',
            'member_id' => 'nullable|exists:members,id'
        ]);

        // Iniciamos una "Transacción". Si algo falla a la mitad (ej. se va la luz), 
        // no se guarda nada a medias y la base de datos queda intacta.
        DB::beginTransaction();

        try {
            $total = 0;
            
            // Recorremos cada producto que nos mandó el Frontend
            foreach ($request->items as $item) {
                $product = Product::find($item['id']);
                
                // Doble validación de stock por seguridad
                if ($product->stock < $item['quantity']) {
                    return response()->json([
                        'status' => 'error',
                        'message' => "Stock insuficiente para: {$product->name}"
                    ], 400);
                }

                // Descontamos el stock y guardamos el producto
                $product->stock -= $item['quantity'];
                $product->save();

                // Sumamos al total de la venta
                $total += ($product->price * $item['quantity']);
            }

            // Registramos el ticket/venta en la base de datos
            $sale = Sale::create([
                'member_id' => $request->member_id,
                'total' => $total,
                'payment_method' => $request->payment_method
            ]);

            // Confirmamos que todo salió bien y guardamos los cambios definitivamente
            DB::commit();

            // Respondemos al Frontend con éxito (para que muestre el Toast verde)
            return response()->json([
                'status' => 'success',
                'message' => 'Cobro realizado con éxito',
                'sale_id' => $sale->id,
                'total' => $total
            ]);

        } catch (\Exception $e) {
            // Si hubo un error, cancelamos la transacción
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Error al procesar el cobro: ' . $e->getMessage()
            ], 500);
        }
    }
}