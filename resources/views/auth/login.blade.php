@extends('layouts.app')

@section('content')
    <section class="sign-in">
        <div class="container">
            <div class="signin-content d-flex justify-content-center">

                <div class="signin-form">
                    <h2 class="form-title">Login</h2>
                    <form method="POST" class="register-form" id="login-form" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email"><i class="fas fa-envelope"></i></label>

                            <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus
                                placeholder="{{ __('Email') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password"><i class="fas fa-key"></i></label>
                            <input id="password" type="password" class="@error('password') is-invalid @enderror"
                                name="password" required autocomplete="current-password" placeholder="{{ __('Senha') }}">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div style="display: flex; align-items: center;">
                                <input type="checkbox" name="remember-me" id="remember-me"/>
                                <label for="remember-me" class="label-agree-term">Lembrar-me</label>
                            </div>
                        </div>



                        <div class="form-group form-button">
                            <button type="submit" class="form-submit" id="signin" name="signin">
                                {{ __('Login') }}
                            </button>
                        </div>
                        <div class="form-group">
                            @if (Route::has('password.request'))
                                <a class="signup-image-link mb-3" href="{{ route('password.request') }}">
                                    {{ __('Esqueceu sua senha ?') }}
                                </a>
                            @endif
                            <a href="{{ route('register') }}" class="signup-image-link">Novo acesso ? Crie sua conta!</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
