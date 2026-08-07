<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('chant_pupitre', function (Blueprint $table) {
            $table->string('audio_path')->nullable()->after('pupitre_id');
        });
    }

    public function down(): void
    {
        Schema::table('chant_pupitre', function (Blueprint $table) {
            $table->dropColumn('audio_path');
        });
    }
};
