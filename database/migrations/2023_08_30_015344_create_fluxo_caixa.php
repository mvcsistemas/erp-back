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
        Schema::create('fluxo_caixa', function (Blueprint $table) {
            $table->id('id_fluxo_caixa')->index();
            $table->uuid()->index();
            $table->string('competencia_fluxo_caixa', 10)->unique()->index();
            $table->decimal('valor_liquido_fluxo_caixa', 13, 2);
            $table->boolean('fechamento_fluxo_caixa');
            $table->decimal('saldo_anterior_fluxo_caixa', 13, 2);
            $table->decimal('saldo_mensal_fluxo_caixa', 13, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fluxo_caixa');
    }
};
