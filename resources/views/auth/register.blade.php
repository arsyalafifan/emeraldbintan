@extends('layouts.app')
<style>
    .input-group-text {
        background: #f8f9fc;
        border-right: 0;
    }

    .form-control {
        border-left: 0;
    }

    .form-control:focus {
        box-shadow: none;
    }
    body {
        padding-top: 80px; /* sesuaikan tinggi navbar */
    }

</style>
@section('content')
<div class="container py-5">
    <div class="row justify-content-center align-items-center min-vh-75">
        <div class="col-lg-5 col-md-7">

            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-4 p-md-5">

                    {{-- Header --}}
                    <div class="text-center mb-4">
                        <h3 class="fw-bold mb-1">{{ __('Create Account') }}</h3>
                        <p class="text-muted small">
                            {{ __('Register to manage Emerald Bintan Travel') }}
                        </p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- Name --}}
                        <div class="mb-3">
                            <label class="form-label">{{ __('Full Name') }}</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="{{ __('Your full name') }}"
                                    required
                                    autofocus
                                >
                            </div>
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Username --}}
                        <div class="mb-3">
                            <label class="form-label">{{ __('Username') }}</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa fa-at"></i>
                                </span>
                                <input
                                    type="text"
                                    name="username"
                                    value="{{ old('username') }}"
                                    class="form-control @error('username') is-invalid @enderror"
                                    placeholder="{{ __('Choose a username') }}"
                                    required
                                >
                            </div>
                            @error('username')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label">{{ __('Email Address') }}</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="{{ __('Email address') }}"
                                    required
                                >
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label class="form-label">{{ __('Password') }}</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa fa-lock"></i>
                                </span>
                                <input
                                    type="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="{{ __('Create password') }}"
                                    required
                                >
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-4">
                            <label class="form-label">{{ __('Confirm Password') }}</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa fa-lock"></i>
                                </span>
                                <input
                                    type="password"
                                    name="password_confirmation"
                                    class="form-control"
                                    placeholder="{{ __('Repeat password') }}"
                                    required
                                >
                            </div>
                        </div>

                        {{-- Submit --}}
                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-semibold">
                            {{ __('Register') }}
                        </button>

                        {{-- Login link --}}
                        <div class="text-center mt-4 small">
                            {{ __('Already have an account?') }}
                            <a href="{{ route('login') }}" class="fw-semibold text-primary">
                                {{ __('Login here') }}
                            </a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
