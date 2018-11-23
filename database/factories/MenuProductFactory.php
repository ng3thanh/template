<?php

use Faker\Generator as Faker;
use App\Models\MenuProduct;

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

$factory->define(MenuProduct::class, function (Faker $faker) {
    return [
        'parent_id' => $faker->numberBetween(0,2),
        'level' => $faker->numberBetween(1,3)
    ];
});
