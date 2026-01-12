@extends('layouts.app')
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #4e73df, #224abe);
        min-height: 100vh;
    }

    .login-card {
        border-radius: 18px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.2);
        overflow: hidden;
    }

    .login-left {
        background: url('https://kabarsdgs.com/wp-content/uploads/2025/04/pantai-trikora-profile1695024664.jpg') center/cover;
        position: relative;
    }

    .login-left::after {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,.45);
    }

    .login-left-content {
        position: relative;
        z-index: 2;
        color: #fff;
        padding: 40px;
    }

    .form-control {
        border-radius: 50px;
        padding-left: 45px;
    }

    .input-icon {
        position: absolute;
        top: 50%;
        left: 18px;
        transform: translateY(-50%);
        color: #aaa;
    }

    .btn-login {
        border-radius: 50px;
        font-weight: 600;
        padding: 10px;
    }

    .brand {
        font-weight: 800;
        letter-spacing: 1px;
    }
</style>
@section('content')
<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="row w-100 justify-content-center">
        <div class="col-lg-9">
            <div class="card login-card">
                <div class="row g-0">

                    <!-- LEFT -->
                    <div class="col-md-6 d-none d-md-block login-left">
                        <div class="login-left-content h-100 d-flex flex-column justify-content-center">
                            <h2 class="brand mb-3">
                                <i class="fas fa-gem me-2"></i> Emerald Bintan
                            </h2>
                            <p class="opacity-75">
                                Dashboard administrasi untuk mengelola paket wisata, destinasi, dan konten website.
                            </p>
                        </div>
                    </div>

                    <!-- RIGHT -->
                    <div class="col-md-6 p-5">
                        <h4 class="fw-bold mb-4 text-center">Login Admin</h4>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email -->
                            <div class="input-group flex-nowrap mb-3 position-relative">
                                <input type="email"
                                       class="form-control"
                                       name="email"
                                       placeholder="Email"
                                       required autofocus>
                            </div>

                            <!-- Password -->
                            <div class="input-group flex-nowrap mb-3 position-relative">
                                <input type="password"
                                       class="form-control"
                                       name="password"
                                       placeholder="Password"
                                       required>
                            </div>

                            <!-- Remember -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember">
                                    <label class="form-check-label small">Ingat saya</label>
                                </div>
                                <a href="{{ route('password.request') }}" class="small">
                                    Lupa password?
                                </a>
                            </div>

                            <!-- Button -->
                            <button type="submit" class="btn btn-primary btn-login w-100">
                                <i class="fas fa-sign-in-alt me-2"></i> Login
                            </button>
                        </form>
                    </div>

                </div>
            </div>

            <p class="text-center text-white-50 mt-4 small">
                &copy; {{ date('Y') }} Emerald Bintan Tour
            </p>
        </div>
    </div>
</div>
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
