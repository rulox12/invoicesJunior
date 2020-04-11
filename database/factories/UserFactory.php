<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    $monthRandom = rand(1, 12);
    $typeRandom = rand(0, 2);
    $types_document = Config::get('users.types_document');

    return [
        'name' => $faker->name,
        'surname' => $faker->name,
        'email' => $faker->email,
        'type_document' => $types_document[$typeRandom],
        'document' => $faker->numberBetween($min = 100000, $max = 9000000),
        'password' => $faker->password,
        'state' => $faker->boolean,
        "created_at" => Carbon::now()->addMonths($monthRandom)
    ];
});
