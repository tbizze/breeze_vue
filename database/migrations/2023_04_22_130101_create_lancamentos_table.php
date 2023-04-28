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
        Schema::create('lancamentos', function (Blueprint $table) {
            $table->id();
            $table->date('lcto_data');
            $table->string('lcto_historico');
            $table->enum('lcto_tipo', ['C', 'D']);
            $table->decimal('lcto_valor');
            $table->string('lcto_notas')->nullable();
            $table->timestamps();
            // Chave estrangeira.
            $table->foreignId('lcto_grupo_id')->constrained();
            // Recurso SoftDelete = guardar na lixeira.
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lancamentos');
    }
};
