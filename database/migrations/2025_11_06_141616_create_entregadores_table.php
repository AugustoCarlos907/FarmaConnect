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
        Schema::create('entregadores', function (Blueprint $table) {
            $table->id();
            $table->string('descricao')->nullable();
            $table->enum('status', ['Ativo', 'Ocupado'])->default('Ativo');
            $table->string('numero_bi')->unique()->nullable();
            $table->string('matricula_veiculo')->nullable();
            $table->string('foto_perfil')->nullable();
            $table->boolean('disponivel' )->default(true);
            
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->foreignId('farmacia_id')    
                  ->constrained('farmacias')
                  ->onDelete('cascade');

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
                       
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entregadores');
    }
};
