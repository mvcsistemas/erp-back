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
        Schema::create('dre_item_grupo', function (Blueprint $table) {
            $table->id('id_dre_item_grupo')->index();
            $table->uuid()->index();
            $table->decimal('valor_dre_item_grupo', 13, 2);
            $table->foreignId('fk_id_grupo_dre')->references('id_grupo_dre')->on('cad_grupo_dre');
            $table->foreignId('fk_id_dre')->references('id_dre')->on('dre')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dre_item_grupo');
    }
};
