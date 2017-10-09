<?php

/*
 * This file is part of Fixhub.
 *
 * Copyright (C) 2016 Fixhub.org
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Fixhub\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create('en_GB');

        for ($i = 1; $i < 10; $i++) {
            User::create([
                'name'           => $faker->userName,
                'nickname'       => $faker->firstName . ' ' . $faker->lastName,
                'email'          => $faker->safeEmail,
                'password'       => bcrypt($faker->password),
                'remember_token' => str_random(10),
            ]);
        }
    }
}
