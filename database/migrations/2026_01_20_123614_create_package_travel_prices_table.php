<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageTravelPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mt_travel_package_prices', function (Blueprint $table) {
            $table->bigIncrements('travelpackagepriceid');
            $table->bigInteger('travelpackageid');
            $table->integer('priceSeq');
            $table->string('packagePriceTitle');
            $table->integer('price');
            $table->string('pricePer')->nullable();
            $table->boolean('isPromo')->default(false);
            $table->integer('promoPrice')->nullable();
            $table->string('priceDesc')->nullable();
            $table->softDeletes();
            $table->string('addBy')->nullable();
            $table->timestamps();
            $table->string('editBy')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mt_travel_package_prices');
    }
}
