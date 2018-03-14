<?php

use Faker\Generator as Faker;

$factory->define(App\CompleteRequirement::class, function (Faker $faker) {
    return [
        'completed_at'=>\Carbon\Carbon::now()
    ];
});
