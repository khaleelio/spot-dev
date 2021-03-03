<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CategoryArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->integer('article_id')->unsigned();

            $table->timestamps();
        });

        // Schema::table('category_articles', function($table) {
        //     $table->foreign('category_id')
        //             ->references('id')->on('categories')
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
        Schema::dropIfExists('category_articles');
    }
}
