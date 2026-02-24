<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('barcode')->unique()->nullable();
        $table->string('name');
        $table->decimal('price', 10, 2); // 10 dígitos en total, 2 decimales
        $table->integer('stock')->default(0);
        
        // Preparación para Facturación Electrónica de México
        $table->string('sat_product_code', 8)->nullable()->comment('Clave de Producto/Servicio del SAT');
        $table->string('sat_unit_code', 3)->nullable()->comment('Clave de Unidad de Medida del SAT (ej. H87, EA)');
        
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
