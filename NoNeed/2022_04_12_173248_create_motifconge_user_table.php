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
        Schema::create('motifconge_user', function (Blueprint $table) {
            $table->foreignId('motifconge_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->increments('id');
            $table->date('date_sortie');
            $table->date('date_entree');
            $table->integer('etat');
            $table->integer('duree');
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
        Schema::dropIfExists('motifconge_user');
    }
};
