@extends('layouts.guest')

@section('title', 'Reset Password')

@section('content')

    <h5 class="mb-3 text-center">Reset your password</h5>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif

    <form action="{{ route('password.email') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" required autofocus>
            @error('email')
                <span class="text-danger" style="font-size:0.9rem">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-2">Send Reset Link</button>

        <div class="text-center mt-3">
            <a href="{{ route('login') }}" style="font-size:0.9rem">Back to Login</a>
        </div>

    </form>

@endsection