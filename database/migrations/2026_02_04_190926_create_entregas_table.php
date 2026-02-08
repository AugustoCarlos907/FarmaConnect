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
        Schema::create('entregas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_id')
                  ->constrained('pedidos')
                  ->cascadeOnDelete();

            $table->foreignId('entregador_id')
                  ->nullable()
                  ->constrained('entregadores')
                  ->nullOnDelete();            
                  
            $table->foreignId('avaliacao_id')
                  ->nullable()
                  ->constrained('avaliacoes')
                  ->nullOnDelete();

            $table->enum('status', ['pendente',  'em_transito', 'entregue', 'cancelada']);
            // ex: pendente, atribuida, em_transito, entregue, cancelada

            $table->decimal('taxa_entrega', 10, 2)->default(0);
            $table->decimal('distancia_km', 8, 2)->nullable();

            $table->timestamp('data_saida')->nullable();
            $table->timestamp('data_entrega')->nullable();

            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entregas');
    }
};
