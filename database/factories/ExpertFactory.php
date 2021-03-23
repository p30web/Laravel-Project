<?php

/* @var $factory Factory */

use App\Expert;
use App\Model;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Expert::class, function (Faker $faker) {
    return [
        'plaque' => json_encode(["iran"=> "10", "first"=> "28", "alphabet"=> "ب", "second"=> "999"]),
        'location_id' => 1,
        'download_pdf_link' => null ,
        'user_expert_id' => null,
        'user_id' => 1,
        'chassisـnumber' => $faker->randomLetter,
        'brand_id' => $faker->numberBetween(1,109),
        'model_id' => $faker->numberBetween(1,817),
        'tracking_code' => $faker->numberBetween(150000,9925000),
        'status' => 1
    ];
});
