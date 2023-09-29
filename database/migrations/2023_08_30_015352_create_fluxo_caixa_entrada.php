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
        Schema::create('fluxo_caixa_entrada', function (Blueprint $table) {
            $table->id('id_fluxo_caixa_entrada')->index();
            $table->uuid()->index();
            $table->date('data_fluxo_caixa_entrada')->index();
            $table->decimal('valor_fluxo_caixa_entrada', 13, 2);
            $table->foreignId('fk_id_tipo_entrada')->references('id_tipo_entrada')->on('cad_tipo_entrada');
            $table->foreignId('fk_id_fluxo_caixa')->references('id_fluxo_caixa')->on('fluxo_caixa')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fluxo_caixa_entrada');
    }
};
