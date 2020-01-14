<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Customer;
use App\Entities\Invoice;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Config;

$factory->define(Invoice::class, function (Faker $faker) {
    $total = $faker->numberBetween($min = 1000, $max = 9000000);
    $states = Config::get('invoices.state');

    return [
        'due_date' => Carbon::now('America/Bogota')->addHours('2'),
        'tax' => $total * 0.16,
        'description' => substr($faker->firstName, 0, 100),
        'total' => $total,
        'type' => substr($faker->firstName, 0, 10),
        'customer_id' => factory(App\Entities\Customer::class)->create()->id,
        'seller_id' => factory(App\Entities\Seller::class)->create()->id,
        'state' => $states[array_rand($states, 1)],
    ];
});
