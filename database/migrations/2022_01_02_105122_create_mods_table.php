<?php

use App\Models\Mod;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mods', function (Blueprint $table) {
            # common data
            $table->id();
            $table->tinyText('name');
            $table->string('slug');
            $table->string('description');
            $table->text('presentation');              // content on the main tab of modification
            $table->enum('game', [Mod::GAME]);         // the game which is base for modification
            $table->integer('views')->default(0);      // how many people viewed this modification
            $table->json('download_links');            // sources to download this modification
			$table->float('average_grade')->default(0); // an average grade for this modification

            # videos about the modification
            $table->tinyText('trailer_video_id')->nullable(); // a link to a mode trailer
            $table->tinyText('review_video_id')->nullable();  // a link to a YouTube video review of the modification

            # relations
            $table->foreignId('author_id')->nullable()->constrained('users')->restrictOnDelete();  # author
            $table->foreignId('guide_id')->nullable()->constrained('posts')->nullOnDelete();        # a POST with a gameplay process guide

            # other links
            $table->json('custom_links');  // links to fixes and additions for the modification
            $table->json('society_links'); // social networks of the developers

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
        Schema::dropIfExists('mods');
    }
}
