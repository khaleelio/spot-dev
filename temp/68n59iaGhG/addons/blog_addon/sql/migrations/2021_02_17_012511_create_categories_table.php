<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title')->nullable();
			$table->string('slug')->nullable();
			$table->string('description')->nullable();
			$table->string('thumb')->nullable();
			$table->text('meta_title')->nullable();
			$table->string('meta_description')->nullable();
			$table->string('keywords')->nullable();
			$table->string('meta_image')->nullable();
			$table->integer('parent_id')->unsigned()->nullable();
			$table->timestamps();
		});

		Schema::table('categories', function($table) {
            $table->foreign('parent_id')
                    ->references('id')->on('categories')
                    // ->onDelete('cascade')
					;
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categories');
	}

}
