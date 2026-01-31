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

                <form action="{{ route('patients.update', $patient) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $patient->name) }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $patient->phone) }}">
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $patient->email) }}">
                    </div>
                    <div class="mb-3">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control"
                            value="{{ old('address', $patient->address) }}">
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('patients.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection