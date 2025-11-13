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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('farmacia_id')->constrained('farmacias')->onDelete('cascade');
            $table->foreignId('entregador_id')->nullable()->constrained('entregadores')->onDelete('set null');
            $table->decimal('valor_total', 10, 2)->nullable();
            $table->enum('status', [ 'Pendente', 'Aprovado','Em Entrega','Concluído','Cancelado'
            ])->default('Pendente');
            $table->dateTime('data_pedido')->default(now());
            $table->dateTime('data_entrega')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
