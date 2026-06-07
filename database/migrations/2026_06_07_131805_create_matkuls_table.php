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
        Schema::create('matkuls', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 15)->unique();
            $table->string('nama', 100);
            $table->unsignedTinyInteger('sks');
            $table->unsignedTinyInteger('semester');
            $table->foreignId('jurusan_id')->constrained()->cascadeOnDelete();
            $table->decimal('avg_rating', 3, 2)->default(0.00);
            $table->unsignedInteger('total_review')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matkuls');
    }
};
