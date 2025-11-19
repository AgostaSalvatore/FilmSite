<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Film;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function index()
    {
        // collect all videogames
        $films = Film::all();

        return response()->json([
            'success' => true,
            'data'    => $films
        ]);
    }

    public function show(Film $film)
    {
        $film->load('director', 'genres');

        return response()->json([
            'success' => true,
            'data'    => $film
        ]);
    }
}
