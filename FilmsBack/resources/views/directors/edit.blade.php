@extends('layouts.master')

@section('title', 'Edit Director')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">Edit Director</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('directors.update', $director) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $director->name }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="surname" class="form-label">Surname</label>
                            <input type="text" class="form-control" name="surname" id="surname" value="{{ $director->surname }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" value="{{ $director->date_of_birth }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="nationality" class="form-label">Nationality</label>
                            <input type="text" class="form-control" name="nationality" id="nationality" value="{{ $director->nationality }}" required>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Update Director</button>
                            <a href="{{ route('directors.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
