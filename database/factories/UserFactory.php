<?php

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'family' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'phone_number' => '0' . $faker->unique()->numberBetween('9390900000','9390905201'),
        'phone_token' => null,
        'phone_token_fails' => 0,
        'email_verified_at' => now(),
        'password' => '$2y$10$FCCGu78N8m2sb/BWgH7lj.wdNn.qRXMBtcgsFizajQESHXwvc7Zcy', // password
        'ip_adress' => $faker->ipv4,
        'remember_token' => Str::random(10),
    ];
});
