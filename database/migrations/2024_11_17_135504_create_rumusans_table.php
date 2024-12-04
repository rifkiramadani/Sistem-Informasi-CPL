<?php

use App\Models\Mata_kuliah;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rumusans', function (Blueprint $table) {
            $table->id();
            // Using foreignIdFor for Mata Kuliah
            $table->foreignIdFor(Mata_kuliah::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rumusans');
    }
};
