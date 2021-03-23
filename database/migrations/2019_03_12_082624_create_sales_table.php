<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('production_id')->unsigned()->index();
            $table->foreign('production_id')->references('id')->on('productions')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('color_id')->nullable()->unsigned()->index();
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('bodystatus_id')->unsigned()->index();
            $table->foreign('bodystatus_id')->references('id')->on('bodystatus')->onDelete('cascade')->onUpdate('cascade');

            $table->string('price', 255);

            $table->boolean('in_place')->comment('نزد ماشین چی؟'); //true false
            $table->integer('cash')->comment('نوع خرید'); //naghd & leasing

            $table->integer('chassi_type')->unsigned()->index();
            $table->foreign('chassi_type')->references('id')->on('chassis_types')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('girbox')->comment('وضعیت گیربکس'); //manual & automatic

            $table->integer('car_status')->comment('وضعیت خودرو'); //کارکرده،صفر،حواله،کارتکس،پیش فروش

            $table->integer('differential')->comment('دیفرانسیل'); //تک دیفرانسیل،تمام چرخ متحرک،دو دیفرانسیل

            $table->json('placestain_id')->nullable();

            $table->string('amortization', 255);

            $table->integer('city_id')->unsigned()->index();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('town_id')->unsigned()->index();
            $table->foreign('town_id')->references('id')->on('towns')->onDelete('cascade')->onUpdate('cascade');

            $table->mediumText('description')->charset('utf8');

            $table->string('status', 255);
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
        Schema::dropIfExists('sales');
    }
}
