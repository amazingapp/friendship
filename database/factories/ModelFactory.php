<?php
$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'employee_id' => $faker->randomNumber(5, true),
        'mobile' => '98' . $faker->randomNumber(8,true),
        'designation' => $faker->jobTitle,
        'branch' => $faker->district . ' Branch',
        'bio' => $faker->paragraph,
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt('kabir'),
        'remember_token' => str_random(10),
    ];
});
