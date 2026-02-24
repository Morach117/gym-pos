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
    Schema::create('access_logs', function (Blueprint $table) {
        $table->id();
        
        // Relación con el socio que puso la huella
        $table->foreignId('member_id')->constrained()->onDelete('cascade');
        
        // ¿Pudo entrar o se le denegó por falta de pago?
        $table->enum('result', ['granted', 'denied']);
        $table->string('reason')->nullable(); // Ej: "Membresía vencida"
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('access_logs');
    }
};
