<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'title'       => $faker->name,
        'description' => $faker->text,
        'status_id'   => function () {
            return App\Status::inRandomOrder()->first()->id;
        }
    ];
});
