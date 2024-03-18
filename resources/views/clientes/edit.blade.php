@extends('partials.header')
@section('styles')
    <link href="{{ asset('css/form.css') }}" rel="stylesheet">
@endsection
@section('main')
    <main>
        <section class="banner" id="banner">
            <div class="position-relative overflow-hidden text-center banner-custon">
                <div class="container custon-container">
                    <div class="mb-5">
                        <h5 class="modal-title" id="modalGanhosLabel">Atualizar Cliente</h5>
                        <p class="text-danger">* Campo obrigatório</p>
                    </div>


                    <form method="POST" class="form-template" action="{{ route('cliente.update', $cliente->id) }}">
                        @method('PUT')
                        @CSRF
                        <div class="form-group">
                            <div class="row mb-5">
                                <div class="form-group col-md-12">
                                    <div class="floating-label">
                                        <input type="text" name="nome" id="nome"
                                            class="form-control @error('nome') is-invalid @enderror"
                                            autocomplete="nome"
                                            value="{{ old('nome', $cliente->nome ?? '') }}" />
                                        <label for="nome">Nome <abbr title="campo obrigatório"
                                                class="text-danger">*</abbr></label>
                                        @error('nome')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="row mb-5">
                                <div class="form-group col-md-12">
                                    <div class="floating-label">
                                        <input type="text" name="cpf" id="cpf"
                                            class="form-control @error('nome') is-invalid @enderror"
                                            autocomplete="cpf"
                                            value="{{ old('cpf', $cliente->cpf ?? '') }}" />
                                        <label for="cpf">CPF <abbr title="campo obrigatório"
                                                class="text-danger">*</abbr></label>
                                        @error('cpf')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="form-group form-button">
                                <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn custon-button-2">Voltar</a>
                                <button type="submit" class="btn custon-button">Atualizar</button>
                            </div>
                        </div>
                </div>
                </form>
            </div>
            </div>

        </section>
    </main>

@endsection
