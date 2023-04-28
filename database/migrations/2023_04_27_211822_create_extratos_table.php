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
        Schema::create('extratos', function (Blueprint $table) {
            $table->id();

            $table->string('status')->nullable();
            $table->string('tp_pgto')->nullable();
            $table->decimal('valor_bruto')->nullable();
            $table->decimal('valor_taxa')->nullable();
            $table->decimal('valor_liquido')->nullable();
            $table->dateTime('dt_transacao')->nullable();
            $table->dateTime('dt_compensacao')->nullable();
            $table->string('ref_transacao')->nullable(); 
            $table->string('serial_leitor')->nullable(); 
            $table->string('memo')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extratos');
    }
};
