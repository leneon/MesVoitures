<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->nullable();
            $table->integer('voiture_id');
            $table->integer('employe_id')->nullable();
            $table->integer('nbre_jrs');
            $table->string('statut')->default('enattente');
            $table->string('etat')->default('active');
            $table->string('numero')->nullable();
            $table->date('date');
            $table->foreign('client_id')->references('id')->on('users');
            $table->foreign('employe_id')->references('id')->on('users');
            $table->foreign('voiture_id')->references('id')->on('voitures');
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
        Schema::dropIfExists('reservations');
    }
}
