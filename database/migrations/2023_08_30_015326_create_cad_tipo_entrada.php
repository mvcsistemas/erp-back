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
        Schema::create('cad_tipo_entrada', function (Blueprint $table) {
            $table->id('id_tipo_entrada')->index();
            $table->uuid()->index();
            $table->string('dsc_tipo_entrada', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cad_tipo_entrada');
    }
};
