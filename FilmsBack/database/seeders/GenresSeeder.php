<?php

namespace Database\Seeders;

use App\Models\Genre;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $genres = ['Action', 'Comedy', 'Drama', 'Horror', 'Romance', 'Sci-Fi', 'Thriller'];

        foreach ($genres as $genre) {
            $newGenre        = new Genre();
            $newGenre->name  = $genre;
            $newGenre->color = $faker->hexColor();
            $newGenre->save();
        }
    }
}
