@extends('layouts.master')

@section('title', 'Film')


@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">Edit Film</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('films.update', $film) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="title" value="{{ $film->title }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="4">{{ $film->description }}</textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="director_id" class="form-label">Director</label>
                            <select class="form-select" name="director_id" id="director_id" required>
                                <option value="">Seleziona un Regista</option>
                                @foreach($directors as $director)
                                    <option value="{{ $director->id }}" {{ $film->director_id == $director->id ? 'selected' : '' }}>
                                        {{ $director->name }} {{ $director->surname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="release_date" class="form-label">Release Date</label>
                                <input type="date" class="form-control" name="release_date" id="release_date" value="{{ $film->release_date }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="rating" class="form-label">Rating</label>
                                <input type="number" class="form-control" step="1" name="rating" id="rating" value="{{ $film->rating }}" min="0" max="10">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="cast" class="form-label">Cast</label>
                            <input type="text" class="form-control" name="cast" id="cast" value="{{ $film->cast }}" placeholder="Actor 1, Actor 2, Actor 3">
                        </div>
                        
                        <div class="mb-3">
                            <label for="trailer" class="form-label">Trailer URL</label>
                            <input type="url" class="form-control" name="trailer" id="trailer" value="{{ $film->trailer }}" placeholder="https://...">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Genres</label>
                            <div class="row">
                                @foreach($genres as $genre)
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="genres[]" id="genre_{{ $genre->id }}" value="{{ $genre->id }}"
                                                {{ $film->genres->contains($genre->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="genre_{{ $genre->id }}">
                                                {{ $genre->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="poster" class="form-label">Poster Image</label>
                            <input type="file" class="form-control" name="poster" id="poster" accept="image/*">
                            @if($film->poster)
                                <small class="text-muted">Current: 

                                    <img 
                                    src="{{ asset('storage/' . $film->poster) }}" 
                                    alt="Poster" 
                                    class="img-fluid"
                                    style="max-width: 100px; max-height: 100px; margin: 10px 10px;"
                                    >
                                </small>
                            @endif
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Update Film</button>
                            <a href="{{ route('films.show', $film) }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
