<?php

use App\Models\Cpl;
use App\Models\Rumusan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rumusan_cpls', function (Blueprint $table) {
            $table->id();
            // Using foreignIdFor for Rumusan and CPL
            $table->foreignIdFor(Rumusan::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Cpl::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rumusan_cpl');
    }
};