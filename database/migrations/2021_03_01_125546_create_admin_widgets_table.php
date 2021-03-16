<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminWidgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_widgets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->longText('object')->nullable();
            $table->longText('value')->nullable();
            $table->string('link')->nullable();
            $table->integer('count')->default(5);
            $table->unsignedBigInteger('parent_id')->default(0);
            // $table->integer('sort')->default(0);
            $table->string('class')->nullable();
            // $table->unsignedBigInteger('widget_id')->nullable();
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
        Schema::dropIfExists('admin_widgets');
    }
}
