<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageStayPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mt_stay_package_prices', function (Blueprint $table) {
            $table->bigIncrements('staypackagepriceid');
            $table->bigInteger('staypackageid');
            $table->string('stayPriceTitle')->nullable();
            $table->integer('price')->nullable();
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
        Schema::dropIfExists('mt_stay_package_prices');
    }
}
