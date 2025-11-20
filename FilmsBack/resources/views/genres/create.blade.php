@extends('layouts.master')

@section('title', 'Create Genre')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h2 class="mb-0">Create New Genre</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('genres.store') }}" method="POST">
                        @csrf  
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="color" class="form-label">Color</label>
                            <input type="color" class="form-control form-control-color" name="color" id="color" value="#563d7c" title="Choose your color" required>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">Create Genre</button>
                            <a href="{{ route('genres.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
