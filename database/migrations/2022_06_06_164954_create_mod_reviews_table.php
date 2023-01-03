<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mod_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->integer('likes');

            # relations
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();  # an author of the mod review
            $table->foreignId('mod_id')->constrained('mods')->cascadeOnDelete();             # a related modification
            $table->foreignId('mod_rating_id')->constrained('mod_ratings');      # a related mod rating

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
        Schema::dropIfExists('mod_reviews');
    }
}
