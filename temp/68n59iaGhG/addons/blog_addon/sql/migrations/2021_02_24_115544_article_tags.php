<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ArticleTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tag_id')->unsigned();
            $table->integer('article_id')->unsigned();

            $table->timestamps();
        });

        // Schema::table('article_tags', function($table) {
        //     $table->foreign('tag_id')
        //             ->references('id')->on('tags')
        //             ->onDelete('cascade');

        //     $table->foreign('article_id')
        //             ->references('id')->on('articles')
        //             ->onDelete('cascade');

        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_tags');
    }
}
