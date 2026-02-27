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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pedido_id')
                  ->constrained('pedidos')
                  ->cascadeOnDelete();

            $table->foreignId('pagamento_id')
                  ->constrained('pagamentos')
                  ->cascadeOnDelete();

            $table->string('numero_factura')->unique();
            $table->decimal('valor_total', 12, 2);
            $table->decimal('iva', 12, 2)->nullable();

            $table->enum('status', [
                'emitida',
                'anulada'
            ])->default('emitida');

            $table->timestamp('emitida_em');

            $table->string('pdf_path')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
