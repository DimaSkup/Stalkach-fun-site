<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_models', static function (Blueprint $table) {
            $table->id();
            $table->morphs('model');            // a model which is associated with a particular file model
            $table->string('type')->nullable(); // a type of the file
            # If File in storage
            $table->foreignId('file_id')->nullable()->constrained()->nullOnDelete();
            # Else File URL
            $table->string('url')->nullable();
            // Time
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
        Schema::dropIfExists('file_models');
    }
};
