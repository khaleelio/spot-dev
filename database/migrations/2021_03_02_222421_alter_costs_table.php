<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('costs', function (Blueprint $table) {
         
           
        });
        Schema::table('costs', function (Blueprint $table) {
            $table->integer('to_state_id')->unsigned();
            $table->integer('from_state_id')->unsigned();
            $table->integer('from_area_id')->unsigned()->nullable();
            $table->integer('to_area_id')->unsigned()->nullable();
            $table->double('shipping_cost')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('costs', function (Blueprint $table) {
            //
        });
    }
}
