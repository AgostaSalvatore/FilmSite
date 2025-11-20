@extends('layouts.master')

@section('title', 'Edit Genre')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">Edit Genre</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('genres.update', $genre) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $genre->name }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="color" class="form-label">Color</label>
                            <input type="color" class="form-control form-control-color" name="color" id="color" value="{{ $genre->color }}" title="Choose your color" required>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Update Genre</button>
                            <a href="{{ route('genres.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
