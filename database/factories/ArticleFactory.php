<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Article;
use App\Models\User;
use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'title'=>$faker->sentence,
        'body'=>$faker->paragraph,
        'author_id'=>User::all(['id'])->random(),
        'category_id'=>Category::all(['id'])->random(),
        'image'=>$faker->image(public_path().'/images/', 200, 200, null, false)
    ];
});
