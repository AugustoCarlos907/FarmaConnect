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
        Schema::create('carrinhos', function (Blueprint $table) {
            $table->id();
            // Dono do carrinho
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // O que foi adicionado
            $table->foreignId('stock_item_id')
                  ->constrained('stock_items')
                  ->onDelete('cascade');

            // Quantidade desejada pelo cliente
            $table->unsignedInteger('quantidade')->default(1);


            // Um user não pode ter o mesmo stock_item duplicado
            // — em vez disso aumenta a quantidade
            $table->unique(['user_id', 'stock_item_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carrinhos');
    }
};
