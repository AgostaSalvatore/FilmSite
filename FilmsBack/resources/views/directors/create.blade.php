@extends('layouts.master')

@section('title', 'Create Director')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h2 class="mb-0">Create New Director</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('directors.store') }}" method="POST">
                        @csrf  
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="surname" class="form-label">Surname</label>
                            <input type="text" class="form-control" name="surname" id="surname" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="nationality" class="form-label">Nationality</label>
                            <input type="text" class="form-control" name="nationality" id="nationality" required>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">Create Director</button>
                            <a href="{{ route('directors.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
