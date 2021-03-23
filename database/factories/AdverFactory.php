<?php

/* @var $factory Factory */

use App\Advertising;
use App\Model;
use App\Expert;
use App\Sale;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Advertising::class, function (Faker $faker) {
    return [
        'title' => $faker->slug,
        'slug' => $faker->slug,
        'brand_id' => $faker->numberBetween(1,109),
        'model_id' => $faker->numberBetween(1,817),
        'user_id' => 1,
        'default_image_id' => null,
//        'expert_id' => function () {
//            return factory(App\Expert::class)->create()->id;
//        },
        'sale_id' => function () {
            return factory(App\Sale::class)->create()->id;
        },
    ];
});

