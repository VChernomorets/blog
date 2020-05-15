<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Post::class, function (Faker $faker) {
    return [
        'header' => $faker->text(80),
        'body' => $faker->paragraph,
        'short_body' => $faker->text(70),
        //'img' => $faker->image('storage/app/public/uploads/post', 640,640, 'cats', false),
        'img' => 'uploads/post/default.jpeg',
        'user_id' => factory(App\User::class)
    ];
});
