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
        Schema::create('farmacias', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // $table->string('email');

            // $table->string('descricao')->nullable();
            $table->unsignedBigInteger('nif');
            $table->string('alvara');  //imagem ou numero

            $table->string('endereco'); 
            $table->string('rua')->nullable();
            $table->string('bairro')->nullable();
            $table->string('municipio')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 10, 8)->nullable();
            
            $table->enum('status', ['Ativo', 'Desativado'])->default('Ativo');

            $table->string('iban');
            $table->string('numero_express');

            $table->foreignId('companhia_id')
                 ->constrained('companhias')
                 ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farmacias');
    }
};
