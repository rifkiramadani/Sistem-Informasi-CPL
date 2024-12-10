<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::create('rumusan_dosens', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('rumusan_id')->constrained('rumusans')->onDelete('cascade'); // Foreign key to rumusans table
        //     $table->foreignId('dosen_id')->constrained('dosens')->onDelete('cascade'); // Foreign key to dosens table
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('rumusan_dosens');
    }
};
