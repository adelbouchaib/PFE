<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('role');
            $table->integer('direction_id');
            $table->string('matricule');
            $table->string('prenom');
            $table->string('nom');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->char('sexe');
            $table->string('lieu_naiss');
            $table->date('date_naiss');
            $table->string('adresse');
            $table->string('num_telephone');
            $table->integer('situation_familiale');
            $table->boolean('situation_conjoint');
            $table->integer('nbr_enfant');

            $table->string('num_securite_social');
            $table->string('num_compte');

            $table->string('fonction');
            $table->char('groupe');
            $table->string('categorie');
            $table->integer('echelon');

            $table->integer('type_contrat');
            $table->date('date_recrutement');
            $table->date('debut_contrat');
            $table->date('fin_contrat')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
