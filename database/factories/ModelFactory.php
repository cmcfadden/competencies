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

$factory->define(App\Models\Competency::class, function (Faker\Generator $faker) {
    static $increment = -1;
    $increment++;
    return [
        'competency' => $faker->text,
        'description' => $faker->paragraph,
        'intro_animation_url' => $faker->url,
        'icon_url' => $faker->url,
        'official_order' => $increment
    ];
});

$factory->define(App\Models\DescriptorTrait::class, function (Faker\Generator $faker) {
    return [
        'trait_title' => $faker->text
    ];
});

$factory->define(App\Models\Descriptor::class, function (Faker\Generator $faker) {
    return [
        'descriptor_text' => $faker->text,
        'descriptor_as_question' => $faker->text
    ];
});

$factory->define(App\Models\Level::class, function (Faker\Generator $faker) {
	static $levelNumber = 0;
	$levelNumber++;
    return [
        'level_number' => $levelNumber,
        'level_description' => $faker->text
    ];
});