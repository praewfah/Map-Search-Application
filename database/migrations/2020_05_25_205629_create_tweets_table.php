<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTweetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweets', function (Blueprint $table) {
            $table->string('city', 128);
            $table->text('fetch', 0);
            $table->text('image');
            $table->text('image_url');
            $table->text('name');
            $table->text('tweet');
            $table->text('latitud');
            $table->text('longitud');
            $table->text('shape_coord')->nullable();
            $table->text('shape_type')->nullable();
            $table->dateTime('updated_at', 0)->nullable();
            $table->dateTime('created_at', 0)->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tweets');
    }
}
