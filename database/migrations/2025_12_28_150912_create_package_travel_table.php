<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageTravelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mt_travel_package', function (Blueprint $table) {
            $table->bigIncrements('travelpackageid');
            $table->string('slug');
            $table->string('packageTitle');
            $table->string('packageDesc');
            $table->time('tourTimeFrom');
            $table->time('tourTimeTo');
            $table->integer('price');
            $table->boolean('isPromo')->default(false);
            $table->integer('promoPrice')->nullable();
            $table->boolean('isRibbon')->default(false);
            $table->string('ribbonText')->nullable();
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
        Schema::dropIfExists('mt_travel_package');
    }
}
