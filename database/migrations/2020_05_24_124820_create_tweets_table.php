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
            $table->dateTime('created_at', 0);
            $table->text('tweet_identify');
            $table->text('tweet_content');
            $table->text('tweet_time');
            $table->text('tweet_profile_name');
            $table->text('tweet_profile_img');
            $table->text('tweet_other');
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
