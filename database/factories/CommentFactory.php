<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Article;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'comment'=>$faker->sentence,
        'author_id'=>User::all(['id'])->random(),
        'article_id'=>Article::all(['id'])->random()
    ];
});
