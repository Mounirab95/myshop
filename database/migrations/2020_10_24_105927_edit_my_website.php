<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditMyWebsite extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('websites', function (Blueprint $table) {
            $table->id();
            $table->string('proposition');
            $table->string('facebook');
            $table->string('youtube');
            $table->string('instagram');
            $table->string('twitter');
            $table->string('Email');
            $table->string('phone');
            $table->string('address');
            $table->string('brefinfo');
            $table->string('about');
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
        Schema::dropIfExists('websites');
    }
}
