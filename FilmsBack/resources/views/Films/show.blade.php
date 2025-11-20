@extends('layouts.master')

@section('title', 'Film')

@section('content')

    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0 text-white">{{ $film->title }}</h1>
                <a href="{{ route('films.index') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-arrow-left"></i> Torna alla lista
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-4 mb-md-0 text-center">
                        @if ($film->poster)
                            <img src="{{ asset('storage/' . $film->poster) }}" alt="{{ $film->title }}" class="img-fluid rounded shadow" style="max-height: 500px;">
                        @else
                            <div class="d-flex justify-content-center align-items-center bg-light rounded shadow" style="height: 400px;">
                                <span class="text-muted">Nessun Poster Disponibile</span>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <h4 class="border-bottom pb-2 mb-3">Dettagli Film</h4>
                        
                        <div class="mb-3">
                            <strong><i class="bi bi-file-text"></i> Descrizione:</strong>
                            <p class="text-muted mt-1">{{ $film->description ?: 'Nessuna descrizione disponibile.' }}</p>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong><i class="bi bi-person-video"></i> Regista:</strong>
                                <p class="mb-0">
                                    <a href="{{ route('directors.show', $film->director) }}" class="text-decoration-none">
                                        {{ $film->director->name }} {{ $film->director->surname }}
                                    </a>
                                </p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong><i class="bi bi-calendar-event"></i> Data di Uscita:</strong>
                                <p class="mb-0">{{ $film->release_date ? \Carbon\Carbon::parse($film->release_date)->format('d/m/Y') : 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong><i class="bi bi-star-fill text-warning"></i> Rating:</strong>
                                <p class="mb-0"><span class="badge bg-secondary">{{ $film->rating }}/10</span></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong><i class="bi bi-people"></i> Cast:</strong>
                                <p class="mb-0">{{ $film->cast ?: 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="mb-3">
                            <strong><i class="bi bi-tags"></i> Generi:</strong>
                            <div class="mt-1">
                                @forelse ($film->genres as $genre)
                                    <span class="badge me-1" style="background-color: {{ $genre->color }}">{{ $genre->name }}</span>
                                @empty
                                    <span class="text-muted fst-italic">Nessun genere associato</span>
                                @endforelse
                            </div>
                        </div>

                        @if($film->trailer)
                            <div class="mb-4">
                                <strong><i class="bi bi-film"></i> Trailer:</strong>
                                <p class="mt-1">
                                    <a href="{{ $film->trailer }}" target="_blank" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-youtube"></i> Guarda Trailer
                                    </a>
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('films.edit', $film) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Modifica
                    </a>
                    
                    <!-- Modal trigger button -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-film">
                        <i class="bi bi-trash"></i> Elimina
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal Body -->
        <div class="modal fade" id="delete-film" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="delete-film-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="delete-film-label">Elimina Film</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h2 class="h5 text-danger">
                            {{ __('Sei sicuro di voler eliminare questo film?') }}
                        </h2>
                        <p class="mt-2 text-muted">
                            {{ __('Una volta eliminato, tutti i suoi dati verranno definitivamente eliminati. Questa azione è irreversibile.') }}
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Annulla') }}</button>
                        <form action="{{ route('films.destroy', $film) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i> {{ __('Elimina') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
