<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Ramsey\Uuid\Uuid;

class CreateExpertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('experts', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->json('plaque')->charset('utf8');

            $table->integer('location_id')->unsigned()->index();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade')->onUpdate('cascade');

            $table->string('download_pdf_link', 255)->nullable();

            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('user_expert_id')->nullable()->comment('آی دی کارشناس');


            $table->integer('brand_id')->unsigned()->index();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('health_status_id')->nullable()->comment('وضعیت سلامت خودرو (ایموجی)');;

            $table->integer('model_id')->unsigned()->index();
            $table->foreign('model_id')->references('id')->on('models')->onDelete('cascade')->onUpdate('cascade');

            $table->string('chassisـnumber')->nullable()->comment('شماره شاسی اتومبیل');
            $table->string('tracking_code')->unique()->nullable()->comment('کد رهگیری برای پیگیری قسمت کارشناسی');

            $table->integer('status');
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
        DB::table('experts')->truncate();
        Schema::dropIfExists('experts');
    }
}
