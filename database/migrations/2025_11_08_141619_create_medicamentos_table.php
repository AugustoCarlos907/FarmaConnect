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
        Schema::create('medicamentos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('descricao');
            // $table->string('principio_ativo');
            $table->string('forma_farmaceutica'); //xarope , comprimido , pomada 
            $table->string('dosagem');

            $table->foreignId('categoria_id')
                  ->constrained('categorias')
                  ->onDelete('cascade');

            $table->timestamps();
            // $table->decimal('preco', 10,2);
            // $table->integer('quantidade');
            // $table->foreignId('farmacia_id')->constrained('farmacias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicamentos');
    }
};
