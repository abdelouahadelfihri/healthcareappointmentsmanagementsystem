@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h1>Welcome, {{ Auth::user()->name }}</h1>
                <p class="text-muted">Select a module from the menu.</p>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>

    </div>
@endsection