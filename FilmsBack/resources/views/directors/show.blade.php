@extends('layouts.master')

@section('title', 'Director Details')

@section('content')
<div class="container py-5">
    <h1>Director Details</h1>
    
    <div class="card shadow mb-4">
        <div class="card-body">
            <p><b>Name:</b> {{ $director->name }}</p>
            <p><b>Surname:</b> {{ $director->surname }}</p>
            <p><b>Date of Birth:</b> {{ $director->date_of_birth }}</p>
            <p><b>Nationality:</b> {{ $director->nationality }}</p>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('directors.edit', $director) }}" class="btn btn-primary">Edit</a>
                
                <!-- Modal trigger button -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-director">
                    Delete
                </button>
                
                <a href="{{ route('directors.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>

    <!-- Modal Body -->
    <div class="modal fade" id="delete-director" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="delete-director-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete-director-label">Delete Director</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 class="text-lg font-medium text-gray-900">
                        Are you sure you want to delete this director?
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        Once deleted, all of their data will be permanently deleted. 
                        @if($director->films()->count() > 0)
                        <strong>Warning: This director has associated films. You may not be able to delete them.</strong>
                        @endif
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('directors.destroy', $director) }}" method="POST">
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
