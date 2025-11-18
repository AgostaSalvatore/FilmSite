@extends('layouts.master')

@section('title', 'Film')

@section('content')

    <div class="container">

    <h1>Dettaglio Film</h1>
    <p><b>Title:</b> {{ $film->title }}</p>
    <p><b>Description:</b> {{ $film->description }}</p>
    <p><b>Poster:</b> {{ $film->poster }}</p>
    <p><b>Director:</b> {{ $film->director->name }} {{ $film->director->surname }}</p>
    <p><b>Trailer:</b> {{ $film->trailer }}</p>
    <p><b>Release Date:</b> {{ $film->release_date }}</p>
    <p><b>Rating:</b> {{ $film->rating }}</p>
    <p><b>Cast:</b> {{ $film->cast }}</p>
    <p><b>Genres:</b> 
        @foreach ($film->genres as $genre)
            <span class="badge" style="background-color: {{ $genre->color }}">{{ $genre->name }}</span>
        @endforeach
    </p>
    
    <!-- Modal trigger button -->
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-film">
        {{__('Elimina')}}
    </button>
    
    <a href="{{ route('films.edit', $film) }}" class="btn btn-primary">Modifica</a>

    <!-- Modal Body -->
    <div class="modal fade" id="delete-film" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="delete-film-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete-film-label">Elimina Film</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Sei sicuro di voler eliminare questo film?') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Una volta eliminato, tutti i suoi dati verranno definitamente eliminati.') }}
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Annulla') }}</button>
                    <form action="{{ route('films.destroy', $film) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">{{ __('Elimina') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
