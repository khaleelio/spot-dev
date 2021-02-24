<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->bigInteger('added_by');
			$table->bigInteger('user_id');
			$table->string('title')->nullable();
			$table->string('slug')->nullable();
			$table->text('content')->nullable();
			$table->string('excerpt')->nullable();
			$table->string('type');
			$table->string('featured_image')->nullable();
			$table->string('video_link')->nullable();
			$table->string('voice_link')->nullable();
			$table->string('gallery')->nullable();
			$table->text('meta_title')->nullable();
			$table->string('meta_description')->nullable();
			$table->string('keywords')->nullable();
			$table->string('meta_image')->nullable();
			$table->text('options')->nullable();
			$table->integer('published')->default(1);
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
		Schema::drop('articles');
	}

}
