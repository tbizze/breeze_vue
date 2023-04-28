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
        Schema::create('lcto_grupos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('notas')->nullable();
            $table->timestamps();
            // Recurso SoftDelete = guardar na lixeira.
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lcto_grupos');
    }
};
