<?php

namespace Database\Seeders;

use App\Models\Director;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DirectorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 10; $i++) {
            $director              = new Director();
            $director->name        = $faker->firstName;
            $director->surname     = $faker->lastName;
            $director->nationality = $faker->country;
            $director->save();
        }
    }
}
