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
            $table->id('id_dre');
            $table->uuid();
            $table->date('data_dre');
            $table->boolean('fechamento_dre');
            $table->timestamps();
            $table->index(['id_dre', 'uuid', 'data_dre']);
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
