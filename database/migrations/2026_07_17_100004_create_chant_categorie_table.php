<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chant_categorie', function (Blueprint $table) {
            $table->foreignId('chant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('categorie_id')->constrained('categories')->cascadeOnDelete();
            $table->primary(['chant_id', 'categorie_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chant_categorie');
    }
};
