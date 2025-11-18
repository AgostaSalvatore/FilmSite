<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Director;
use Illuminate\Http\Request;

class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $directors = Director::all();
        return view('directors.index', compact('directors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('directors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $newDirector                = new Director();
        $newDirector->name          = $data['name'];
        $newDirector->surname       = $data['surname'];
        $newDirector->date_of_birth = $data['date_of_birth'];
        $newDirector->nationality   = $data['nationality'];
        $newDirector->save();

        return redirect()->route('directors.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Director $director)
    {
        return view('directors.show', compact('director'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Director $director)
    {
        return view('directors.edit', compact('director'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Director $director)
    {
        $data = $request->all();

        $director->name          = $data['name'];
        $director->surname       = $data['surname'];
        $director->date_of_birth = $data['date_of_birth'];
        $director->nationality   = $data['nationality'];
        $director->save();

        return redirect()->route('directors.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Director $director)
    {
        // Verifica se ci sono film associati
        if ($director->films()->count() > 0) {
            return redirect()
                ->route('directors.index')
                ->with('error', 'Impossibile eliminare il regista: ci sono film associati.');
        }

        // Elimina il regista
        $director->delete();

        return redirect()
            ->route('directors.index')
            ->with('success', 'Regista eliminato con successo.');
    }
}
