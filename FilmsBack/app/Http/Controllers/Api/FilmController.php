<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    public function index(Request $request)
    {
        // collect all films
        // $films = Film::with('director', 'genres')->get();
        $query = Film::with('director', 'genres');

        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->has('genre')) {
            $query->whereHas('genres', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->genre . '%');
            });
        }

        $films = $query->get();
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
