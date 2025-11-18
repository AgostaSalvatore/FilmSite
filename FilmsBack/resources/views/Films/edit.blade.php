@extends('layouts.master')

@section('title', 'Film')


@section('content')
<div class="container">
    <h1>Edit Film</h1>
    <form action="{{ route('films.update', $film) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ $film->title }}">
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description">{{ $film->description }}</textarea>
        </div>
        <div>
            <label for="poster">Poster URL</label>
            <input type="text" name="poster" id="poster" value="{{ $film->poster }}">
        </div>
        <div>
            <label for="trailer">Trailer URL</label>
            <input type="text" name="trailer" id="trailer" value="{{ $film->trailer }}">
        </div>
        <div>
            <label for="director_id">Director</label>
            <select name="director_id" id="director_id">
                <option value="">Seleziona un Regista</option>
                @foreach($directors as $director)
                    <option value="{{ $director->id }}" {{ $film->director_id == $director->id ? 'selected' : '' }}>
                        {{ $director->name }} {{ $director->surname }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="release_date">Release Date</label>
            <input type="date" name="release_date" id="release_date" value="{{ $film->release_date }}">
        </div>
        <div>
            <label for="rating">Rating</label>
            <input type="number" step="1" name="rating" id="rating" value="{{ $film->rating }}">
        </div>
        <div>
            <label for="cast">Cast</label>
            <input type="text" name="cast" id="cast" value="{{ $film->cast }}">
        </div>
        <div>
            <label>Genres</label>
            @foreach($genres as $genre)
                <div>
                    <input type="checkbox" name="genres[]" id="genre_{{ $genre->id }}" value="{{ $genre->id }}"
                        {{ $film->genres->contains($genre->id) ? 'checked' : '' }}>
                    <label for="genre_{{ $genre->id }}">{{ $genre->name }}</label>
                </div>
            @endforeach
        </div>
        <div>
            <button type="submit">Update Film</button>
        </div>
    </form>
</div>
@endsection
