<?php

/* @var $factory Factory */

use App\Model;
use App\Sale;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Sale::class, function (Faker $faker) {
    return [
        'production_id' => $faker->numberBetween(1,63),
        'color_id' => $faker->numberBetween(1,27),
        'price' => $faker->numberBetween(125000,9925000),
        'bodystatus_id' => $faker->numberBetween(1,18),
        'placestain_id' => json_encode($faker->randomElement(array('1', '2', '3'))),
        'amortization' => $faker->numberBetween(500,99999999),
        'city_id' => $faker->numberBetween(1,31),
        'town_id' => $faker->numberBetween(1,342),
        'description' => $faker->text,
        'status' => 1 ,
        'in_place' => $faker->boolean,
        'cash' => $faker->numberBetween(1,2),
        'chassi_type' => $faker->numberBetween(1,6),
        'girbox' => $faker->numberBetween(1,2),
        'car_status' => $faker->numberBetween(1,5),
        'differential' => $faker->numberBetween(1,3),
    ];
});
