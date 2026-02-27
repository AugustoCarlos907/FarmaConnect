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
        Schema::create('transacoes_bancarias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pagamento_id')
                  ->constrained('pagamentos')
                  ->cascadeOnDelete();
    
            // $table->string('iban_origem')->nullable();
            // $table->string('nome_pagador')->nullable();
            $table->string('referencia_bancaria')->nullable();

            $table->decimal('valor_detectado', 12, 2);
            $table->timestamp('data_transacao')->nullable();

            $table->boolean('reconciliado')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transacoes_bancarias');
    }
};
