<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Director;
use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $films = Film::all();
        return view('films.index', compact('films'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $directors = Director::all();
        $genres    = Genre::all();
        return view('films.create', compact('directors', 'genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data                  = $request->all();
        $newFilm               = new Film();
        $newFilm->title        = $data['title'];
        $newFilm->description  = $data['description'];
        $newFilm->poster       = $data['poster'];
        $newFilm->trailer      = $data['trailer'];
        $newFilm->release_date = $data['release_date'];
        $newFilm->rating       = $data['rating'];
        $newFilm->cast         = $data['cast'];
        $newFilm->director_id  = $data['director_id'];
        $newFilm->save();

        // Associa i genres selezionati
        if (isset($data['genres'])) {
            $newFilm->genres()->attach($data['genres']);
        }

        return redirect()->route('films.show', $newFilm);
    }

    /**
     * Display the specified resource.
     */
    public function show(Film $film)
    {
        return view('films.show', compact('film'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Film $film)
    {
        $directors = Director::all();
        $genres    = Genre::all();
        return view('films.edit', compact('film', 'directors', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Film $film)
    {
        $data               = $request->all();
        $film->title        = $data['title'];
        $film->description  = $data['description'];
        $film->poster       = $data['poster'];
        $film->trailer      = $data['trailer'];
        $film->release_date = $data['release_date'];
        $film->rating       = $data['rating'];
        $film->cast         = $data['cast'];
        $film->director_id  = $data['director_id'];
        $film->save();

        // Sincronizza i genres selezionati
        if (isset($data['genres'])) {
            $film->genres()->sync($data['genres']);
        }

        return redirect()->route('films.show', $film);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Film $film)
    {
        // Rimuovi prima le relazioni many-to-many con i genres
        $film->genres()->detach();

        // Poi elimina il film
        $film->delete();

        return redirect()->route('films.index');
    }
}
