@extends('layouts.master')

@section('title', 'Film')


@section('content')
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
            <label for="release_date">Release Date</label>
            <input type="date" name="release_date" id="release_date" value="{{ $film->release_date }}">
        </div>
        <div>
            <label for="rating">Rating</label>
            <input type="number" step="1" name="rating" id="rating" value="{{ $film->rating }}">
        </div>
        <div>
            <label for="director">Director</label>
            <input type="text" name="director" id="director" value="{{ $film->director }}">
        </div>
        <div>
            <label for="cast">Cast</label>
            <input type="text" name="cast" id="cast" value="{{ $film->cast }}">
        </div>
        <div>
            <button type="submit">Update Film</button>
        </div>
    </form>
@endsection
