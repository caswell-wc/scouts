<?php

use Faker\Generator as Faker;

$factory->define(App\Adventure::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,
        'rank_id'=>function(){
            return factory(\App\Rank::class)->create()->id;
        }
    ];
});
