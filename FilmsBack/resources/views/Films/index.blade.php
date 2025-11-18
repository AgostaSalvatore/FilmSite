@extends('layouts.master')

@section('title', 'Films')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestione Film</h1>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Poster</th>
                    <th>Director</th>
                    <th>Trailer</th>
                    <th>Release Date</th>
                    <th>Rating</th>
                    <th>Cast</th>
                    <th>Genres</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @forelse($films as $film)
                    <tr>
                        <td>{{ $film->id }}</td>
                        <td>{{ Str::words($film->title, 5, '...') }}</td>
                        <td>{{ Str::words($film->description, 10, '...') }}</td>
                        <td>{{ $film->poster }}</td>
                        <td>{{ $film->director->name }} {{ $film->director->surname }}</td>
                        <td>{{ $film->trailer }}</td>
                        <td>{{ $film->release_date }}</td>
                        <td>{{ $film->rating }}</td>
                        <td>{{ $film->cast }}</td>
                        <td>
                            @foreach ($film->genres as $genre)
                                <span class="badge" style="background-color: {{ $genre->color }}">{{ $genre->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('films.show', $film) }}" class="btn btn-sm btn-info">Dettagli</a>
                            <a href="{{ route('films.edit', $film) }}" class="btn btn-sm btn-warning">Modifica</a>
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete-film-{{ $film->id }}">
                                Elimina
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="delete-film-{{ $film->id }}" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="delete-film-label-{{ $film->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="delete-film-label-{{ $film->id }}">Elimina Film</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-lg font-medium text-gray-900">
                                                {{ __('Sei sicuro di voler eliminare questo film?') }}
                                            </h2>
                                            <p class="mt-1 text-sm text-gray-600">
                                                {{ __('Film: ') }} <strong>{{ $film->title }}</strong>
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
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="text-center">Nessun film disponibile</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
