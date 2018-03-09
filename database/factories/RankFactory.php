<?php

use Faker\Generator as Faker;

$factory->define(App\Rank::class, function (Faker $faker) {
    return [
        'name'=>'Test Rank'
    ];
});
