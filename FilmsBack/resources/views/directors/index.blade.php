@extends('layouts.master')

@section('title', 'Directors')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestione Registi</h1>
        <a href="{{ route('directors.create') }}" class="btn btn-primary">Aggiungi Regista</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Cognome</th>
                    <th>Data di Nascita</th>
                    <th>Nazionalità</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @forelse($directors as $director)
                    <tr>
                        <td>{{ $director->id }}</td>
                        <td>{{ $director->name }}</td>
                        <td>{{ $director->surname }}</td>
                        <td>{{ $director->date_of_birth }}</td>
                        <td>{{ $director->nationality }}</td>
                        <td>
                            <a href="{{ route('directors.show', $director) }}" class="btn btn-sm btn-info">Dettagli</a>
                            <a href="{{ route('directors.edit', $director) }}" class="btn btn-sm btn-warning">Modifica</a>
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete-director-{{ $director->id }}">
                                Elimina
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="delete-director-{{ $director->id }}" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="delete-director-label-{{ $director->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="delete-director-label-{{ $director->id }}">Elimina Regista</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-lg font-medium text-gray-900">
                                                {{ __('Sei sicuro di voler eliminare questo regista?') }}
                                            </h2>
                                            <p class="mt-1 text-sm text-gray-600">
                                                {{ __('Regista: ') }} <strong>{{ $director->name }} {{ $director->surname }}</strong>
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Annulla') }}</button>
                                            <form action="{{ route('directors.destroy', $director) }}" method="POST">
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
                        <td colspan="6" class="text-center">Nessun regista disponibile</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
