<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chants', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->longText('paroles'); // version courante
            $table->string('tonalite')->nullable();
            $table->string('audio_path')->nullable();
            $table->string('partition_path')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chants');
    }
};
