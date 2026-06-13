@extends('layouts.guest')

@section('title', 'Login')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif

    <form action="{{ route('login.post') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" required autofocus>
            @error('email')
                <span class="text-danger" style="font-size:0.9rem">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password"
                class="form-control @error('password') is-invalid @enderror" required>
            @error('password')
                <span class="text-danger" style="font-size:0.9rem">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-2">Login</button>

        <div class="text-center mt-3">
            <a href="{{ route('password.request') }}" style="font-size:0.9rem">Forgot Password?</a>
        </div>

    </form>

@endsection