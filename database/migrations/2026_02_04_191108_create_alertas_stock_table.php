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
        Schema::create('alertas_stock', function (Blueprint $table) {
            $table->id();

            $table->foreignId('stock_items_id')
                  ->constrained('stock_items')
                  ->onDelete('cascade');
                  
            $table->enum('tipo', ['baixo_stock', 'validade_proxima']);
            $table->text('mensagem');
            // $table->boolean('lido')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alertas_stock');
    }
};
