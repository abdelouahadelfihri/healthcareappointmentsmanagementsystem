@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Edit Service</h1>
            <a href="{{ route('services.index') }}" class="btn btn-secondary">
                Back
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('services.update', $service) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $service->name) }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description"
                            class="form-control">{{ old('description', $service->description) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label>Price</label>
                        <input type="number" step="0.01" name="price" class="form-control"
                            value="{{ old('price', $service->price) }}">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="{{ route('services.index') }}" class="btn btn-secondary ml-3">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection