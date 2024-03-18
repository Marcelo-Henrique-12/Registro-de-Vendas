@extends('layouts.app')

@section('content')
    <section class="signup">
        <div class="container">
            <div class="signup-content d-flex justify-content-center">
                <div class="signup-form">
                    <h2 class="form-title">Registre-se</h2>
                    <form method="POST" class="register-form" id="register-form" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name"><i class="fas fa-user"></i></label>
                            <input type="text" name="name" id="nome_completo"
                                placeholder="{{ __('Nome Completo') }}" class="@error('name') is-invalid @enderror"
                                required autocomplete="name" autofocus value="{{ old('name') }}" />

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email"><i class="fas fa-envelope"></i></label>
                            <input type="email" name="email" id="email" placeholder="{{ __('E-Mail ') }}"
                                class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                                required autocomplete="email" />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password"><i class="fas fa-key"></i></label>
                            <input type="password" name="password" id="password"
                                placeholder="{{ __('Senha') }}"class="@error('password') is-invalid @enderror"
                                name="password" required autocomplete="new-password" />

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password-confirm"><i class="fas fa-check-circle"></i></label>


                            <input id="password-confirm" type="password" name="password_confirmation" required
                                autocomplete="new-password" placeholder="{{ __('Confirmar senha') }}">
                        </div>


                        <div class="form-group form-button">
                            <button type="submit" class="form-submit">
                                {{ __('Cadastrar') }}
                            </button>
                        </div>
                    </form>

                    <div class="form-group">
                        <a href="{{ route('login') }}" class="signup-image-link">Já possuí acesso ? Faça o Login!</a>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
