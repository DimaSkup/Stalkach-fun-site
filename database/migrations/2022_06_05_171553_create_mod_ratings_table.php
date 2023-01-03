<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mod_ratings', function (Blueprint $table) {
            $table->id();

            # grades
            $table->unsignedTinyInteger('story');
            $table->unsignedTinyInteger('graphics');
            $table->unsignedTinyInteger('difficulty');
            $table->unsignedTinyInteger('optimization');
            $table->unsignedTinyInteger('atmosphere');
            $table->unsignedTinyInteger('main');

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
        Schema::dropIfExists('mod_ratings');
    }
}
