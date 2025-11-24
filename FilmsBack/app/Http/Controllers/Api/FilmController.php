<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    public function index()
    {
        // collect all videogames
        $films = Film::with('director', 'genres')->get();

        // Aggiungi l'URL completo per il poster
        $films->each(function ($film) {
            if ($film->poster) {
                $film->poster_url = url('storage/' . $film->poster);
            }
        });

        return response()->json([
            'success' => true,
            'data'    => $films
        ]);
    }

    public function show(Film $film)
    {
        $film->load('director', 'genres');

        // Aggiungi l'URL completo per il poster
        if ($film->poster) {
            $film->poster_url = url('storage/' . $film->poster);
        }

        return response()->json([
            'success' => true,
            'data'    => $film
        ]);
    }
}
