@extends('layouts.app')

@section('content')
{{-- <div class="container form-login">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('error'))
                <div class="alert alert-danger mb-4 text-center">
                    <strong>{{ session('error') }}</strong>
                </div>
            @endif
        </div>
    </div>
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


<div class="container form-login">
    <div class="row content">
        <div class="col-md-6">
            <img src="{{ asset('img/Papaya_salad_banner_logo_cartoon_art_illustration.jpg') }}" class="img-fluid" alt="Image">
        </div>
        <div class="col-md-6">
            <h3 class="login-text mb-3">Login</h3>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control-login" value="{{ old('email') }}">
                    @error('email')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control-login" value="{{ old('password') }}">
                    @error('password')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember" class="form-check-label">Remember Me</label>
                </div>
                <button type="submit" class="btn btn-class">Login</button>
            </form>
        </div>
    </div>
</div>
@endsection
