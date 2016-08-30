<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags_to_posts', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('article_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->timestamps();

            $table->foreign('article_id')
                ->references('id')
                ->on('news')
                ->onDelete('cascade');

            $table->foreign('tag_id')
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
        Schema::drop('tags_to_posts');
    }
}
