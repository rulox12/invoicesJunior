<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Seller;
use Faker\Generator as Faker;

$factory->define(Seller::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'surname' => $faker->name,
        'type_document' => $faker->name,
        'document' => $faker->randomNumber(6),
        'state' => $faker->boolean
    ];
});
