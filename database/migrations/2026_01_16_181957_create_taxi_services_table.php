<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxiServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mt_taxi_services', function (Blueprint $table) {
            $table->bigIncrements('taxiserviceid');
            $table->bigInteger('destinationid');
            $table->integer('price7seatoneway')->nullable();
            $table->integer('price7seattwoway')->nullable();
            $table->integer('price14seatoneway')->nullable();
            $table->integer('price14seattwoway')->nullable();
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
        Schema::dropIfExists('mt_taxi_services');
    }
}
