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
        Schema::create('rumusan_cpl_cpmk', function (Blueprint $table) {
            $table->id();
            $table->integer('rumusan_cpl_id');
            $table->integer('cpmk_id');
            $table->integer('skor_maks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rumusans_cpl_cpmk');
    }
};