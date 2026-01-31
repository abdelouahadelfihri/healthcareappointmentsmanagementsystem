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
                    <button type="submit" class="btn btn-success">Save</button>
                    <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>

    </div>
@endsection




@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add Doctor</h1>
        <form action="{{ route('doctors.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Specialty</label>
                <input type="text" name="specialty" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control">
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection