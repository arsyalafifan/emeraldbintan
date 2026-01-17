<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarRentalServiceImgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mt_car_rental_service_imgs', function (Blueprint $table) {
            $table->bigIncrements('carrentalserviceimgid');
            $table->bigInteger('carrentalserviceid');
            $table->string('imgUrl');
            $table->string('imgDesc');
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
        Schema::dropIfExists('mt_car_rental_service_imgs');
    }
}
