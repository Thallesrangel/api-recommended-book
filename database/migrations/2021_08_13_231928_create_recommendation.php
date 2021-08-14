<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecommendation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recommendation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_indicator');
            $table->unsignedBigInteger('user_indicated');
            $table->string('title');
            $table->string('description');
            $table->string('flag_status');
            $table->timestamps();
        });

        Schema::table('recommendation', function($table) {
            $table->foreign('user_indicator')->references('id')->on('user');
            $table->foreign('user_indicated')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recommendation');
    }
}
