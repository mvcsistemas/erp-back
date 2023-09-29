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
        Schema::create('dre_grupo', function (Blueprint $table) {
            $table->id('id_dre_grupo')->index();
            $table->uuid()->index();
            $table->string('dsc_gre_grupo', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dre_grupo');
    }
};
