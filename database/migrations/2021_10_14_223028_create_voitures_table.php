<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoituresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voitures', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('matricule');
            $table->integer('categorie_id');
            $table->foreign('categorie_id')->references('id')->on('categories');
            $table->text('description');
            $table->string('disponibilite');
            $table->float('prix');
            $table->string('photo_int');
            $table->string('photo_ext');
            $table->string('photo_avt');
            $table->string('photo_arr');
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
        Schema::dropIfExists('voitures');
    }
}
