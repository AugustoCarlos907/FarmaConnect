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
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pedido_id')
                  ->constrained('pedidos')
                  ->onDelete('cascade');

            $table->enum('metodo', ['iban', 'express', 'dinheiro'])->default('Dinheiro');
            $table->decimal('valor', 10, 2);

            $table->string('referencia')->nullable(); // referência interna
            $table->string('iban_destino')->nullable();
            $table->string('numero_express')->nullable();


            $table->enum('status', ['pendente', 'confirmado', 'cancelado'])->default('Pendente');

            $table->timestamp('data_pagamento')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagamentos');
    }
};
