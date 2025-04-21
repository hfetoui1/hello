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
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id();
            $table->text('contenu');

            // Liens vers administrateur et profil
            $table->foreignId('administrateur_id')->constrained('administrateurs')->onDelete('cascade');
            $table->foreignId('profil_id')->constrained('profils')->onDelete('cascade');

            $table->timestamps();
            $table->unique(['administrateur_id', 'profil_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commentaires');
    }
};
