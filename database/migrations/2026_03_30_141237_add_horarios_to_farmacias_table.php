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
        Schema::table('farmacias', function (Blueprint $table) {

            // $table->timestamp('horario_abertura')->after('companhia_id')->nullable();
            $table->timestamp('horario_fechamento')->nullable()->after('horario_abertura');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('farmacias', function (Blueprint $table) {
            //
        });
    }
};
