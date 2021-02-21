<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterClientsTableV1Rollback extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('products_type');
            $table->dropColumn('pickup_cost');
            $table->dropColumn('merchant_note');
            $table->dropColumn('max_delivery_days');
            $table->dropColumn('kilo_price');
            $table->dropColumn('merchant_code');
            $table->dropColumn('stock_service');
            $table->dropColumn('packaging_service');
            $table->dropColumn('protection_service');
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
            $table->dropColumn('products_type');
            $table->dropColumn('pickup_cost');
            $table->dropColumn('merchant_note');
            $table->dropColumn('max_delivery_days');
            $table->dropColumn('kilo_price');
            $table->dropColumn('merchant_code');
            $table->dropColumn('stock_service',10,2);
            $table->dropColumn('packaging_service',10,2);
            $table->dropColumn('protection_service',10,2);
        });
    }
}
