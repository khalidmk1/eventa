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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('price')->default('free');
            $table->longText('image')->nullable();
            $table->string('categorie')->nullable();
            $table->longText('tags')->nullable();
            $table->string('title')->nullable();
            $table->string('city')->nullable();
            $table->string('adresse')->nullable();
            $table->longText('description')->nullable();
            $table->longText('programme')->nullable();
            $table->dateTime('date_start')->nullable();
            $table->dateTime('date_end')->nullable();
            $table->string('video')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('events');
    }
};
