@extends('layouts.master')

@section('title', 'Film')

@section('content')

    <h1>Dettaglio Film</h1>
    <p>{{ $film->title }}</p>
    <p>{{ $film->description }}</p>
    <p>{{ $film->poster }}</p>
    <p>{{ $film->trailer }}</p>
    <p>{{ $film->genre }}</p>
    <p>{{ $film->release_date }}</p>
    <p>{{ $film->rating }}</p>
    <p>{{ $film->director }}</p>
    <p>{{ $film->cast }}</p>
    
    <!-- Modal trigger button -->
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-film">
        {{__('Elimina')}}
    </button>

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
@endsection
