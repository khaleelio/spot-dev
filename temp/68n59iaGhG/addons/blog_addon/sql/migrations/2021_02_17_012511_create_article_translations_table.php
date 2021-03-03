<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('article_translations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->bigInteger('article_id');
			$table->string('title');
			$table->string('excerpt')->nullable();
			$table->text('content');
			$table->text('meta_title')->nullable();
			$table->string('meta_description')->nullable();
			$table->string('keywords')->nullable();
			$table->string('lang');
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
		Schema::drop('article_translations');
	}

}
