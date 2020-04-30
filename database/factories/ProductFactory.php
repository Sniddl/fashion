<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        "name" => $faker->words(3, true),
        "cover_image" => $faker->imageUrl(640, 480),
        "quantity" => $faker->numberBetween(0, 2000),
        "available" => $faker->randomElement([true, false]),
        "currency" => $faker->randomElement(["usd", "cad", "cny", "aed", "inr"]),
        "price" => $faker->randomFloat(2, 5, 1000),
        "description" => $faker->paragraphs(3, true),
        "scout_comment" => $faker->realText(200, 2),
    ];
});
