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
        Schema::create('stock_items', function (Blueprint $table) {
            $table->id();
            $table->integer('quantidade')->default(0);
            $table->decimal('preco', 10, 2); 
            $table->date('data_validade');
            $table->string('lote');
            $table->boolean('ativo')->default(true);

            $table->foreignId('medicamento_id')
                  ->constrained('medicamentos')
                                    ->onDelete('cascade');
                  
            $table->foreignId('farmacia_id')
                  ->constrained('farmacias')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_items');
    }
};
