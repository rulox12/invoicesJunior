<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Seller;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Seller::class, function (Faker $faker) {
    $monthRandom = rand(1, 12);
    $typeRandom = rand(0, 2);
    $types_document = Config::get('users.types_document');

    return [
        'name' => $faker->name,
        'surname' => $faker->name,
        'type_document' => $types_document[$typeRandom],
        'document' => $faker->randomNumber(6),
        'state' => $faker->boolean,
        "created_at" => Carbon::now()->addMonths($monthRandom)
    ];
});
