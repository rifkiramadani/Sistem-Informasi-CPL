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
        Schema::create('rumusan_mahasiswa_nilais', function (Blueprint $table) {
            $table->id();
            // Foreign key to rumusan_mahasiswas table
            $table->foreignId('rumusan_mahasiswa_id')->constrained('rumusan_mahasiswas')->onDelete('cascade');

            // Foreign key to rumusan_cpl_cpmk table
            $table->foreignId('rumusan_cpl_cpmk_id')->constrained('rumusan_cpl_cpmks')->onDelete('cascade');

            // Nilai (score) based on skor_maks with default 0
            $table->decimal('nilai', 5, 2)->default(0); // You can adjust the precision as needed

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rumusan_mahasiswa_nilais');
    }
};