@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        <h1 class="mb-4">Edit Purchase Order #{{ $purchaseOrder->id }}</h1>

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
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="{{ route('doctors.index') }}" class="btn btn-secondary ml-3">Cancel</a>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const params = new URLSearchParams(window.location.search);

            if (params.get("selected_supplier_id")) {
                document.getElementById("supplier_id").value = params.get("selected_supplier_id");
            }
            if (params.get("selected_request_id")) {
                document.getElementById("request_id").value = params.get("selected_request_id");
            }
        });
    </script>

@endsection




@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Doctor</h1>
        <form action="{{ route('doctors.update', $doctor) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $doctor->name) }}" required>
            </div>
            <div class="mb-3">
                <label>Specialty</label>
                <input type="text" name="specialty" class="form-control" value="{{ old('specialty', $doctor->specialty) }}"
                    required>
            </div>
            <div class="mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $doctor->phone) }}">
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $doctor->email) }}">
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('doctors.index') }}" class="btn btn-secondary ml-3">Cancel</a>
        </form>
    </div>
@endsection