@extends('layouts.master')

@section('title', 'Genres')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestione Genres</h1>
        <a href="{{ route('genres.create') }}" class="btn btn-primary">Aggiungi Genere</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Colore</th>
                    <th>Anteprima</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @forelse($genres as $genre)
                    <tr>
                        <td>{{ $genre->id }}</td>
                        <td>{{ $genre->name }}</td>
                        <td>{{ $genre->color }}</td>
                        <td>
                            <span class="badge" style="background-color: {{ $genre->color }}">{{ $genre->name }}</span>
                        </td>
                        <td>
                            <a href="{{ route('genres.show', $genre) }}" class="btn btn-sm btn-info">Dettagli</a>
                            <a href="{{ route('genres.edit', $genre) }}" class="btn btn-sm btn-warning">Modifica</a>
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete-genre-{{ $genre->id }}">
                                Elimina
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="delete-genre-{{ $genre->id }}" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="delete-genre-label-{{ $genre->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="delete-genre-label-{{ $genre->id }}">Elimina Genere</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-lg font-medium text-gray-900">
                                                {{ __('Sei sicuro di voler eliminare questo genere?') }}
                                            </h2>
                                            <p class="mt-1 text-sm text-gray-600">
                                                {{ __('Genere: ') }} <strong>{{ $genre->name }}</strong>
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Annulla') }}</button>
                                            <form action="{{ route('genres.destroy', $genre) }}" method="POST">
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
                        <td colspan="5" class="text-center">Nessun genere disponibile</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
