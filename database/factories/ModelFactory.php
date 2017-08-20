<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
    ];
});

$factory->define(App\Models\Country::class, function(Faker\Generator $faker) {
    return [
        'code' => $faker->unique()->countryCode,
        'name' => $faker->country,
    ];
});

$factory->define(App\Models\Genre::class, function(Faker\Generator $faker) {
    return [
        'name' => $faker->unique()->name,
    ];
});

$factory->define(App\Models\Label::class, function(Faker\Generator $faker) {
    return [
        'name' => $faker->unique()->name,
    ];
});

$factory->define(App\Models\Artist::class, function(Faker\Generator $faker) {

    $artistName = $faker->name;

    return [
        'name' => $artistName,
        'begin_date' => $faker->dateTimeBetween(
            $startDate = '-50 years',
            $endDate = '-20 years',
            $timezone = date_default_timezone_get()
        ),
        'end_date' => $faker->dateTimeBetween(
            $startDate = '-20 years',
            $endDate = 'now',
            $timezone = date_default_timezone_get()
        ),
        'label_id' => function() {
            return factory(App\Models\Label::class)->create()->id;
        },
        'slug' => (new \App\Slug\Slug($artistName))->generate()
    ];
});

$factory->define(App\Models\Recording::class, function(Faker\Generator $faker) {
    return [
        'title' => $faker->name,
        'length' => $faker->numberBetween(1,120),
        'release_date' => $faker->dateTimeBetween(
            $startDate = '-50 years',
            $endDate = 'now',
            $timezone = date_default_timezone_get()
        ),
        'image_path' => $faker->imageUrl($width = 640, $height = 480),
    ];
});

$factory->define(App\Models\Track::class, function(Faker\Generator $faker) {
    return [
        'title' => $faker->sentence($nbWords = 4, $variableNbWords = true) ,
        'length' => $faker->numberBetween(1,120),
        'recording_id' => function() {
            return factory(App\Models\Recording::class)->create()->id;
        },
    ];
});
