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
        Schema::create('relatorios', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('pedido_id')
                  ->nullable()
                  ->constrained('pedidos')
                  ->onDelete('set null');

            // $table->foreignId('cliente_id')->nullable()->constrained('clientes')->onDelete('set null');
            $table->foreignId('farmacia_id')
                  ->nullable()->constrained('farmacias')
                  ->onDelete('set null');
                  
            $table->string('tipo_relatorio');
            $table->text('descricao')->nullable();
            $table->dateTime('data_geracao')->default(now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relatorios');
    }
};
