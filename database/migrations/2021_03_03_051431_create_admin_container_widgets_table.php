<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminContainerWidgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_container_widgets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('widget_id')->nullable();
            $table->unsignedBigInteger('container_id')->nullable();
            $table->string('title');
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->longText('object')->nullable();
            $table->longText('value')->nullable();
            $table->string('link')->nullable();
            $table->integer('sort')->default(0);
            $table->string('class')->nullable();
            $table->unsignedBigInteger('parent_id')->default(0);
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
        Schema::dropIfExists('admin_container_widgets');
    }
}
