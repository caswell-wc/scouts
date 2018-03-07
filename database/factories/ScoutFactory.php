<?php

use Faker\Generator as Faker;

$factory->define(App\Scout::class, function (Faker $faker) {
    return [
        'first_name'=>'John',
        'last_name'=>'Scout',
        'birth_date'=>\Carbon\Carbon::parse('-8 years'),
        'address'=>'123 Main St.',
        'city'=>'Scoutsville',
        'state'=>'UT',
        'postal_code'=>'90210',
        'phone_number'=>'(801)555-1212',
        'email'=>'scout@scouts.test'
    ];
});
