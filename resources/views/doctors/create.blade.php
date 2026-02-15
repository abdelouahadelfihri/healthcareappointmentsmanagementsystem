@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        <h1 class="mb-4">Create Customer</h1>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('customers.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email (optional)</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="{{ route('doctors.index') }}" class="btn btn-secondary ml-3">Cancel</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection