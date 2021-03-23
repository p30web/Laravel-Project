<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisingImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertising_image', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('image_path')->nullable();

            $table->integer('advertising_id')->unsigned()->index();
            $table->foreign('advertising_id')->references('id')->on('advertisings')->onUpdate('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertising_image');
    }
}
