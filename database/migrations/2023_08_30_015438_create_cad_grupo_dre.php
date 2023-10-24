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
        Schema::create('cad_grupo_dre', function (Blueprint $table) {
            $table->id('id_grupo_dre')->index();
            $table->uuid()->index();
            $table->string('dsc_grupo_dre', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cad_grupo_dre');
    }
};
