<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags_tags', function (Blueprint $table) {
            $table->bigInteger('original_tag_id')->unsigned()->nullable();
            $table->foreign('original_tag_id')
                    ->references('id')
                    ->on('tags')
                    ->onDelete('cascade');

            $table->bigInteger('assigned_tag_id')->unsigned()->nullable();
            $table->foreign('assigned_tag_id')
                    ->references('id')
                    ->on('tags')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags_tags');
    }
}
