<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Article;
use App\Models\User;
use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'title'=>$faker->sentence,
        'body'=>$faker->paragraph,
        'author_id'=>App\Model\User::all(['id'])->random(),
        'category_id'=>App\Model\Category::all(['id'])->random(),
        'image'=>$faker->image(public_path('images'))
    ];
});
