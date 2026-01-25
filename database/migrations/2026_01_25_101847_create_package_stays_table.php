<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageStaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mt_stay_package', function (Blueprint $table) {
            $table->bigIncrements('staypackageid');
            $table->string('slug');
            $table->string('stayTitle');
            $table->string('stayDesc')->nullable();
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
        Schema::dropIfExists('mt_stay_package');
    }
}
