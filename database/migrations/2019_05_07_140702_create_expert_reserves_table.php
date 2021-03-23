<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpertReservesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expert_reserves', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('expert_id')->unsigned()->index();
            $table->foreign('expert_id')->references('id')->on('experts')->onDelete('cascade');

            $table->json('reserveDate')->comment('تاریخ و ساعت رزرو ها جهت شمارش');
            $table->json('reserveDetails')->nullable()->comment('جزییات رزرو');
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
        Schema::dropIfExists('expert_reserves');
    }
}
