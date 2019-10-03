<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AdminUser;
use Faker\Generator as Faker;

$factory->define(AdminUser::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
          'last_name' => $faker->lastName,
            'email' => $faker->unique()->safeEmail,
            'password' => $faker->password,
          'api_token' => Str::random(60),
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now()
    ];
});
