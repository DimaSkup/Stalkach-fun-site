<?php

use app\Models\Post;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->text('text');
            $table->string('slug')->unique();
            $table->string('video_id')->nullable();  // if this post has a video type this field contains a YouTube video id

            # Content scope
            $table->enum('type', Post::getTypes()->all());
            //$table->enum('category', Post::CATEGORIES);

            # Author
            $table->foreignId('user_id')->nullable()->constrained('users')->restrictOnDelete();
            $table->string('source_title')->nullable();  // a post author's nickname
            $table->string('source_url')->nullable();    // a link to the source page from where we get data for a post

            # Other relations
            $table->foreignId('post_category_id')->constrained('post_categories');

            # Tracking
            $table->bigInteger('views');

            # Parameters
            $table->boolean('is_pinned');
            $table->boolean('is_feature');
            $table->boolean('is_ad');
            $table->boolean('is_approved');
            $table->string('duration')->nullable();
            $table->json('settings')->nullable()->default(null);

            # Timestamps
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
