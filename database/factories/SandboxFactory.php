<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Sandbox;
use App\AdminUser;
use Faker\Generator as Faker;

$factory->define(Sandbox::class, function (Faker $faker) {
    return [
        'admin_user_id' => factory(AdminUser::class),
        'name' => $faker->name,
        'origin' => 'website',
        'voucher' => rand(0, 1)
    ];
});
