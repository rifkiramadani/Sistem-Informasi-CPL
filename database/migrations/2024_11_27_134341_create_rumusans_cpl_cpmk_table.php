<?php

use App\Models\Cpmk;
use App\Models\RumusanCpl;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rumusan_cpl_cpmks', function (Blueprint $table) {
            $table->id();
            // Using foreignIdFor for RumusanCpl and CPMK
            $table->foreignIdFor(RumusanCpl::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Cpmk::class)->constrained()->onDelete('cascade');
            $table->integer('skor_maks'); // Regular column for skor_maks
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rumusan_cpl_cpmk');
    }
};