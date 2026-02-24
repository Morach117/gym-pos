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
    Schema::create('sales', function (Blueprint $table) {
        $table->id();
        
        // El socio puede ser null si es una venta a "público en general"
        $table->foreignId('member_id')->nullable()->constrained()->onDelete('set null');
        
        $table->decimal('total', 10, 2);
        $table->string('payment_method')->default('cash'); // cash, card, transfer
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
