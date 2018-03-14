<?php

use Faker\Generator as Faker;

$factory->define(App\Requirement::class, function (Faker $faker) {
    return [
        'requireable_type'=>'Test Type',
        'requireable_id'=>1,
        'number'=>'1',
        'description'=>'Test Description'
    ];
});
