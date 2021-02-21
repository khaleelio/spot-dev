<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterClientsTableV1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('products_type');
            $table->integer('pickup_cost');
            $table->longText('merchant_note')->nullable();
            $table->integer('max_delivery_days')->default(0);
            $table->double('kilo_price')->default(10);
            $table->string('merchant_code')->default("0");
            $table->double('stock_service',10,2)->default('0');
            $table->double('packaging_service',10,2)->default('0');
            $table->double('protection_service',10,2)->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            //
        });
    }
}
