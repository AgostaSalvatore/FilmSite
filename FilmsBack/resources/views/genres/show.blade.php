@extends('layouts.master')

@section('title', 'Genre Details')

@section('content')
<div class="container py-5">
    <h1>Genre Details</h1>
    
    <div class="card shadow mb-4">
        <div class="card-body">
            <p><b>Name:</b> {{ $genre->name }}</p>
            <p><b>Color:</b> <span class="badge" style="background-color: {{ $genre->color }}; color: #fff; text-shadow: 1px 1px 1px #000;">{{ $genre->color }}</span></p>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('genres.edit', $genre) }}" class="btn btn-primary">Edit</a>
                
                <!-- Modal trigger button -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-genre">
                    Delete
                </button>
                
                <a href="{{ route('genres.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>

    <!-- Modal Body -->
    <div class="modal fade" id="delete-genre" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="delete-genre-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete-genre-label">Delete Genre</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 class="text-lg font-medium text-gray-900">
                        Are you sure you want to delete this genre?
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        Once deleted, all associated data will be permanently deleted.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('genres.destroy', $genre) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
