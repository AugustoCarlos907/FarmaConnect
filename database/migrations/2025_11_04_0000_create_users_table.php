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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('logo')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->date('data_nascimento')->nullable();
            
            
            $table->enum('genero' , ['M' , 'F'])->nullable();
            
            $table->text('endereco')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();

           $table->enum('role', [
                'cliente',
                'gestor_companhia',
                'gestor_farmacia',
                'entregador',
                'admin'
            ])->default('cliente');


            $table->foreignId('companhia_id')
                  ->nullable()
                  ->constrained('companhias')
                  ->onDelete('cascade');

            $table->foreignId('farmacia_id')
                  ->nullable()
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
        Schema::dropIfExists('users');
    }
};
