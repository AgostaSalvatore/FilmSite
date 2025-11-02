@extends('layouts.master')

@section('title', 'Film')


@section('content')
<div class="container">
    <h1>Create Film</h1>
    <form action="{{ route('films.store') }}" method="POST">
        @csrf  
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title">
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description"></textarea>
        </div>
        <div>
            <label for="release_date">Release Date</label>
            <input type="date" name="release_date" id="release_date">
        </div>
        <div>
            <label for="rating">Rating</label>
            <input type="number" step="1" name="rating" id="rating">
        </div>
        <div>
            <label for="cast">Cast</label>
            <input type="text" name="cast" id="cast">
        </div>
        <div>
            <button type="submit">Create Film</button>
        </div>
    </form>
</div>
@endsection
