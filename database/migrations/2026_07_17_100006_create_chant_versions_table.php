<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chant_versions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chant_id')->constrained()->cascadeOnDelete();
            $table->longText('paroles'); // état des paroles avant la modification
            $table->foreignId('modifie_par')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chant_versions');
    }
};
