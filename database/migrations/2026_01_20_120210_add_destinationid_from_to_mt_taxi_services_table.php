<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDestinationidFromToMtTaxiServicesTable extends Migration
{
    public function up()
    {
        Schema::table('mt_taxi_services', function (Blueprint $table) {
            $table->bigInteger('destinationid_from')
                  ->nullable()
                  ->after('destinationid');
        });
    }

    public function down()
    {
        Schema::table('mt_taxi_services', function (Blueprint $table) {
            $table->dropColumn('destinationid_from');
        });
    }
}
