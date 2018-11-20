<?php

use Faker\Generator as Faker;
use App\Models\Products;

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
$autoIncrement = autoIncrement();

$factory->define(Products::class, function (Faker $faker) use ($autoIncrement) {
    $autoIncrement->next();
    return [
        'code' => 'PR00' . $autoIncrement->current(),
        'menu_id' => $faker->numberBetween(1,5),
        'view' => $faker->numberBetween(1,250),
        'publish_date' => $faker->dateTime('2014-02-25 08:37:17'),
        'end_date' => $faker->dateTime('2024-02-25 08:37:17'),
    ];
});

function autoIncrement()
{
    for ($i = 0; $i < 1000; $i++) {
        yield $i;
    }
}