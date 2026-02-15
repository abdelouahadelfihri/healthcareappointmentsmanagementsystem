@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Edit Patient</h1>
            <a href="{{ route('patients.index') }}" class="btn btn-secondary">
                Back
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('patients.update', $patient->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $patient->name) }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" name="date_of_birth" class="form-control"
                            value="{{ old('date_of_birth', $patient->date_of_birth) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $patient->phone) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email (optional)</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $patient->email) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control"
                            rows="3">{{ old('address', $patient->address) }}</textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="{{ route('patients.index') }}" class="btn btn-secondary ml-3">Cancel</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection