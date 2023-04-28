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
        Schema::create('faturas', function (Blueprint $table) {
            $table->id();

            $table->date('dt_venc');
            $table->date('dt_pgto');
            $table->decimal('valor_pgto');
            $table->string('notas')->nullable();

            $table->timestamps();
            // Recurso SoftDelete = guardar na lixeira.
            $table->softDeletes();
            // Chave estrangeira.
            $table->foreignId('fat_operadora_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faturas');
    }
};
