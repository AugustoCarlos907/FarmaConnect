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
        Schema::create('comprovativo_pagamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pagamento_id')->constrained()->cascadeOnDelete();

            $table->string('arquivo_path');
            $table->string('hash_arquivo')->nullable(); // prevenir duplicação

            $table->json('dados_extraidos')->nullable(); // resultado do parse OCR (ex: valor, data, IBAN)

            $table->enum('status_validacao', [
                'pendente',
                'valido',
                'invalido'
            ])->default('pendente');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comprovativo_pagamentos');
    }
};
