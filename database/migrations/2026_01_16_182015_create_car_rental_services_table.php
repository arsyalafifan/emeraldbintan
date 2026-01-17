<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarRentalServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mt_car_rental_services', function (Blueprint $table) {
            $table->bigIncrements('carrentalserviceid');
            $table->string('type');
            $table->integer('pricehalfday')->nullable();
            $table->integer('pricefullday')->nullable();
            $table->integer('pricewholeday')->nullable();
            $table->integer('priceadditional')->nullable();
            $table->string('includes')->nullable();
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
        Schema::dropIfExists('mt_car_rental_services');
    }
}
