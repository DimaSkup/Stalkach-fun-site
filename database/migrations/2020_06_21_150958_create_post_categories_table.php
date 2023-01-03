<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_categories', function (Blueprint $table) {
            $table->id();

            $table->tinyText("name");        // contains a translation of this category name
            $table->tinyText("dev_name");    // contains a raw category name
            $table->tinyText("description");
            $table->tinyText("slug");

            # pinned
            $table->tinyText("pinned_title")->nullable();       // a title of pinned posts
            $table->tinyText("pinned_subtitle")->nullable();    // a subtitle of pinned posts
            $table->text("pinned_description")->nullable();     // a description, additional information

            //$table->foreignId("background_image_id")->constrained("file_models");  // an image for category pages

            $table->boolean('is_private');  // to checking if people can write posts for this particular category
            $table->boolean('is_enabled');  // to show this category in the menu or not

            $table->softDeletes();
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
        Schema::dropIfExists('post_categories');
    }
}
