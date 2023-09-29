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
        Schema::create('dre_itens', function (Blueprint $table) {
            $table->id('id_dre_item')->index();
            $table->uuid()->index();
            $table->decimal('aliquota', 13, 2);
            $table->decimal('valor_dre_item', 13, 2);
            $table->string('dsc_dre_item', 255);
            $table->foreignId('fk_id_grupo_dre')->references('id_dre_grupo')->on('dre_grupo');
            $table->foreignId('fk_id_dre')->references('id_dre')->on('dre')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dre_itens');
    }
};
