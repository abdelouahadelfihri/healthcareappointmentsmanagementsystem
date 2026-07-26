@extends('layouts.app')

@section('content')
    @if (session('success'))
        <script>
            alert(@json(session('success')));
        </script>
    @endif
    <div class="container mt-4">

        <h1 class="mb-4">Edit Doctor #{{ $doctor->id }}</h1>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('doctors.update', $doctor) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $doctor->name) }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label>Specialty</label>
                        <input type="text" name="specialty" class="form-control"
                            value="{{ old('specialty', $doctor->specialty) }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $doctor->phone) }}">
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $doctor->email) }}">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2">Update</button>
                        <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection