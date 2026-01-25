<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageStayImgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mt_stay_package_imgs', function (Blueprint $table) {
            $table->bigIncrements('staypackageimgid');
            $table->bigInteger('staypackageid');
            $table->string('imgUrl');
            $table->string('imgDesc')->nullable();
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
        Schema::dropIfExists('mt_stay_package_imgs');
    }
}
