<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'surname' => $faker->name,
        'email' => $faker->email,
        'type_document' => $faker->name,
        'document' => $faker->numberBetween($min = 100000, $max = 9000000),
        'password' => $faker->password,
        'role_id' => factory(App\Entities\Role::class)->create()->id,
        'state' => $faker->boolean
    ];
});
