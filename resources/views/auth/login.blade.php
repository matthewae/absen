@extends('layouts.app')

@section('content')
<style>
    body {
        background: url('/path/to/background-image.jpg') no-repeat center center fixed;
        background-size: cover;
    }

    .sidebar {
        background: navy;
        color: white;
        min-height: 100vh;
        padding: 2rem;
        transition: transform 0.3s ease;
    }

    .sidebar h1 {
        color: yellow;
    }

    .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    .card {
        border: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
</style>
<div class="container-fluid login-container">
    <div class="row w-100">
        <!-- Sidebar -->
        <div class="col-md-4 sidebar">
            <h1>PT. Mandajaya</h1>
            <h4>Rekayasa Konstruksi</h4>
            <p>Absensi Karyawan</p>
        </div>

        <!-- Login Form -->
        <div class="col-md-8 d-flex justify-content-center align-items-center">
            <div class="card rounded-4 p-4" style="width: 100%; max-width: 400px;">
                <h4 class="text-center mb-4">Login</h4>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                        @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection