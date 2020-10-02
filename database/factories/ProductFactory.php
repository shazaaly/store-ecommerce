<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\models\Product;
use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        //
        'name'=> $faker->text('60'),
        'description'=> $faker->paragraph(),
        'short_description'=>$faker->text(),
        'price'=>$faker->numberBetween(10, 9000),
        'manage_stock'=>false,
        'slug'=>$faker->slug(),
        'sku'=>$faker->word(),
        'is_active'=>$faker->boolean(),
        'in_stock'=>$faker->boolean(),

    ];
});
