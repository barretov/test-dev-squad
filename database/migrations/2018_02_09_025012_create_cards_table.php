<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->increments('id')->comment('Card index');
            $table->integer('idLst')->comment('List index');
            $table->integer('owner')->comment('Card owner');
            $table->integer('crd_order')->comment('Order of car in the list');
            $table->string('data', 800)->nullable()->comment('Card data');
            $table->string('crd_invite', 100)->nullable()->comment('Email for invite new user');
            $table->timestamps();
            $table->foreign('idLst')->references('id')->on('lists')->onDelete('cascade');
            $table->foreign('owner')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
