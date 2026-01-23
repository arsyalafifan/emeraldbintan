<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyPackageTravelPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mt_travel_package_prices', function (Blueprint $table) {
            $table->string('packagePriceTitle')->nullable()->change();
            $table->integer('price')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mt_travel_package_prices', function (Blueprint $table) {
            $table->string('packagePriceTitle')->nullable(false)->change();
            $table->integer('price')->nullable(false)->change();
        });
    }
}
