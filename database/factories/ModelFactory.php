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
$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
            'user_id' => factory('App\User')->create()->id,
            'message' => $faker->sentence
            ];
});
$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
            'user_id' => factory('App\User')->create()->id,
            'post_id' => factory('App\Post')->create()->id,
            'message' => $faker->sentence
            ];
});