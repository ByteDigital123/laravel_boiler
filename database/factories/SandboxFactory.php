<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Sandbox;
use App\AdminUser;
use Faker\Generator as Faker;

$factory->define(Sandbox::class, function (Faker $faker) {
    $origins = ['Web Orders', 'Phone Orders', 'Shop Orders', 'Sagepay Orders'];
    return [
        'admin_user_id' => factory(AdminUser::class),
        'name' => $faker->company,
        'origin' => $origins[array_rand($origins, 1)],
        'voucher' => rand(0, 1)
    ];
});
