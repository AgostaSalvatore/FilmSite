@extends('layouts.master')

@section('title', 'Film')

@section('content')
<div class="container">
    <h1>Lista Film</h1>
    <ul>
        @foreach ($films as $film)
            <li>{{ $film->title }}
                <a href="{{ route('films.show', $film) }}">Show</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection