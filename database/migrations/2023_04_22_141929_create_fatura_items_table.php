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
        Schema::create('fatura_items', function (Blueprint $table) {
            $table->id();
            $table->date('dt_compra');
            $table->string('historico');
            $table->string('parcelas');
            $table->decimal('valor_compra');
            $table->string('notas')->nullable();
            $table->timestamps();
            // Recurso SoftDelete = guardar na lixeira.
            $table->softDeletes();
            // Chave estrangeira.
            $table->foreignId('fatura_id')->constrained();
            $table->foreignId('fat_grupo_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fatura_items');
    }
};
