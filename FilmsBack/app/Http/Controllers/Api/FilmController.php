<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Director;
use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    public function index(Request $request)
    {
        // 1. Costruzione Query
        $query = Film::with('director', 'genres');

        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->has('genre')) {
            $query->whereHas('genres', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->genre . '%');
            });
        }

        // 2. Paginazione (16 per pagina)
        $films = $query->orderBy('created_at', 'desc')->paginate(16);

        // 3. Arricchimento dati (Poster)
        $films->getCollection()->transform(function ($film) {
            if ($film->poster) {
                // Se inizia con http, è un URL esterno (TMDB), altrimenti è locale
                if (str_starts_with($film->poster, 'http')) {
                    $film->poster_url = $film->poster;
                } else {
                    $film->poster_url = url('storage/' . $film->poster);
                }
            }
            return $film;
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
            if (str_starts_with($film->poster, 'http')) {
                $film->poster_url = $film->poster;
            } else {
                $film->poster_url = url('storage/' . $film->poster);
            }
        }

        return response()->json([
            'success' => true,
            'data'    => $film
        ]);
    }
}
