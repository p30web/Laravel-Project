<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesExpertTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties_expert', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('expert_id');

            $table->string('health_rating', 255)->nullable()->comment('درجه کلی سلامتی خودرو');
            $table->json('battery_health')->nullable()->comment('سلامت باتری');
            $table->json('mechanic')->nullable()->comment('مکانیک خودرو');
            $table->json('paint')->nullable()->comment('مشخصات رنگ و نقاشی بدنه');
            $table->json('electric')->nullable()->comment('سیستم های الکتریکی');
            $table->json('safety')->nullable()->comment('سیستم های ایمنی');
            $table->json('wheels')->nullable()->comment('رینگ و تایر');
            $table->json('check_document')->nullable()->comment('بررسی مدارک');
            $table->json('check_option')->nullable()->comment('بررسی آپشن');
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
        Schema::dropIfExists('properties_expert');
    }
}
