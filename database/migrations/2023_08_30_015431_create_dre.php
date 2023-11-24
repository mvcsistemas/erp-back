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
        Schema::create('dre', function (Blueprint $table) {
            $table->id('id_dre')->index();
            $table->uuid()->index();
            $table->string('competencia_dre', 10)->unique()->index();
            $table->boolean('fechamento_dre');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dre');
    }
};
