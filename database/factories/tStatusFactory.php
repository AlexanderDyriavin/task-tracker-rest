<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\TodoStatus;
use Faker\Generator as Faker;

$factory->define(TodoStatus::class, function () {
    $titles = ['View','In Progress','Done'];

    return [
    ];
});
