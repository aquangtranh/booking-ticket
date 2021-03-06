<?php

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

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'full_name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('12345'), // secret
        'address' => $faker->address,
        'last_login_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'phone' => $faker->tollFreePhoneNumber(),
        'remember_token' => str_random(10),
    ];
});
