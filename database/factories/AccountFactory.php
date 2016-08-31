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


use App\Modules\DataModel\Models\Account;
use Database\Seeds\AccountsTableSeeder;

//use Illuminate\Database\Eloquent\Factory;

// define normal account with random agent in [1,40]
$factory->defineAs(Account::class, 'administrator', function ($faker) use ($factory) {
    $acc = $factory->raw(Account::class);

    return array_merge($acc, [
        'AccountType' => 0
    ]);
});

// define agent account with random root agent in [1,20]
$factory->defineAs(Account::class, 'editor', function ($faker) use ($factory) {
    $acc = $factory->raw(Account::class);

    return array_merge($acc, [
        'AccountType' => 1
    ]);
});

// define common attribute of account
$factory->define(Account::class, function (Faker\Generator $faker) {
    return [
        'Account' => $faker->bankAccountNumber,
        'password' => bcrypt('secret'),
        'AccountStatus' => $faker->numberBetween(0,1),
        'email' => $faker->email,
        'Address' => $faker->unique()->address,
        'Name' => $faker->name,
        'Phone' => $faker->phoneNumber,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
    ];
});
