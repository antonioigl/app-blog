<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use App\Comment;
use App\User;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence($nbWords = 4, $variableNbWords = true),
        'article_id' => Article::all()->random()->id,
        'user_id' => User::all()->random()->id,
        'content' => $faker->text($maxNbChars = 200),
    ];
});
