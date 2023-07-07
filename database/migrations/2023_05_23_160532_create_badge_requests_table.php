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
        Schema::create('badge_requests', function (Blueprint $table) {
            $table->id();
            $table->string('demandeur_nom');
            $table->string('demandeur_prenom');
            $table->string('demandeur_directeur');
            $table->string('demandeur_fonction');
            $table->string('demandeur_telephone');
            $table->string('demandeur_matricule');
            $table->date('date');
            $table->string('beneficiaire_nom');
            $table->string('beneficiaire_prenom');
            $table->string('beneficiaire_direction');
            $table->string('beneficiaire_fonction');
            $table->string('beneficiaire_telephone');
            $table->string('beneficiaire_employeur');
            $table->string('beneficiaire_matricule');
            $table->enum('categorie_badge', ['Permanent staff', 'Consultant', 'Temporaire']);
            $table->date('date_debut');
            $table->date('date_fin');
            $table->text('motivation');
            $table->json('approvers')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('badge_requests');
    }
};
