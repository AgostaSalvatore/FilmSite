<?php

namespace Database\Seeders;

use App\Models\Film;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FilmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 10; $i++) {
            $film               = new Film();
            $film->title        = $faker->sentence(3);
            $film->description  = $faker->text(100);
            $film->poster       = $faker->imageUrl(640, 480, 'movies', true);
            $film->director_id  = rand(1, 10);
            $film->trailer      = $faker->url();
            $film->release_date = $faker->date('Y-m-d');
            $film->rating       = $faker->numberBetween(1, 10);
            $film->cast         = $faker->name();
            $film->save();
        }
    }
}
