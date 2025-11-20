@extends('layouts.master')

@section('title', 'Films')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Gestione Film</h1>
            <a href="{{ route('films.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Aggiungi Film
            </a>
        </div>

        <div class="card shadow">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th style="width: 80px;">Poster</th>
                                <th>Title</th>
                                <th class="d-none d-lg-table-cell">Director</th>
                                <th class="d-none d-xl-table-cell">Release Date</th>
                                <th>Rating</th>
                                <th class="d-none d-md-table-cell">Genres</th>
                                <th class="text-end">Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($films as $film)
                                <tr>
                                    <td>{{ $film->id }}</td>
                                    <td>
                                        @if($film->poster)
                                            <img src="{{ asset('storage/' . $film->poster) }}" alt="Poster" class="img-thumbnail" style="width: 50px; height: 75px; object-fit: cover;">
                                        @else
                                            <span class="text-muted small">No img</span>
                                        @endif
                                    </td>
                                    <td class="fw-bold">
                                        {{ Str::limit($film->title, 30) }}
                                        <div class="d-lg-none small text-muted">
                                            {{ $film->director->name }} {{ $film->director->surname }}
                                        </div>
                                    </td>
                                    <td class="d-none d-lg-table-cell">{{ $film->director->name }} {{ $film->director->surname }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $film->release_date }}</td>
                                    <td>
                                        <span class="badge bg-secondary">
                                            <i class="bi bi-star-fill text-warning"></i> {{ $film->rating }}
                                        </span>
                                    </td>
                                    <td class="d-none d-md-table-cell">
                                        @foreach ($film->genres as $genre)
                                            <span class="badge" style="background-color: {{ $genre->color }}">{{ $genre->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="text-end">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('films.show', $film) }}" class="btn btn-sm btn-outline-info" title="Dettagli">
                                                <i class="bi bi-search"></i>
                                            </a>
                                            <a href="{{ route('films.edit', $film) }}" class="btn btn-sm btn-outline-warning" title="Modifica">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete-film-{{ $film->id }}" title="Elimina">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade text-start" id="delete-film-{{ $film->id }}" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="delete-film-label-{{ $film->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="delete-film-label-{{ $film->id }}">Elimina Film</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h2 class="h5 text-danger">
                                                            {{ __('Sei sicuro di voler eliminare questo film?') }}
                                                        </h2>
                                                        <p class="mt-2 text-muted">
                                                            {{ __('Stai per eliminare: ') }} <strong>{{ $film->title }}</strong>.<br>
                                                            {{ __('Questa azione è irreversibile.') }}
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
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="bi bi-film display-4 text-muted mb-2"></i>
                                            <p class="text-muted">Nessun film disponibile</p>
                                            <a href="{{ route('films.create') }}" class="btn btn-primary btn-sm">Aggiungi il primo film</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
