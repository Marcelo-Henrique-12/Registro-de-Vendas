@extends('partials.header')
@section('styles')
    <link href="{{ asset('css/form.css') }}" rel="stylesheet">
@endsection
@section('main')
    <main>
        <section class="banner" id="banner">
            <div class="position-relative overflow-hidden text-center banner-custon">
                <div class="container custon-container">

                    <div class="cadastro-section mb-5">
                        <h3 class="mb-3">Produtos</h3>
                        <button type="button" class="btn custon-button" data-toggle="modal" data-target="#modalProdutos"><i
                                class="fas fa-plus"></i> Cadastrar</button>
                    </div>
                    <hr>
                    <h3 class="mt-5 mb-4">Registros</h3>
                    <div class="registros-section d-flex justify-content-center mb-5">
                        <div class="card card-secondary card-outline tabela-despesas">
                            <div class="card-body table-responsive p-0">
                                @if ($produtos->count() > 0)
                                    <table class="table table-bordered table-striped table-sm dataTable dtr-inline">
                                        <thead>
                                            <tr>
                                                <th colspan="4" style="text-align: center">Produtos</th>
                                            </tr>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Valor Unitário</th>
                                                <th style="width: 1%;">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($produtos as $produto)
                                                <tr>
                                                    <td>{{ $produto->nome }}</td>
                                                    <td>R$ {{ $produto->valor }}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="{{ route('produto.edit', $produto->id) }}"
                                                                type="button" class="btn btn-primary" title="Editar">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                            <button type="button" class="btn btn-danger"
                                                                data-toggle="modal"
                                                                data-target="#modal-default{{ $produto->id }}"
                                                                title="Excluir">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>

                                                        </div>
                                                        <div class="modal fade" id="modal-default{{ $produto->id }}"
                                                            style="display: none;" aria-hidden="true" data-backdrop="static"
                                                            data-keyboard="false">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Excluir produto</h4>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">×</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Caso prossiga com a exclusão do item, o mesmo não
                                                                            poderá ser mais
                                                                            recuperado. Deseja realmente excluir?</p>
                                                                    </div>
                                                                    <div class="modal-footer justify-content-between">
                                                                        <button type="button" class="btn btn-default"
                                                                            data-dismiss="modal">Fechar</button>
                                                                        <form method="POST"
                                                                            action="{{ route('produto.destroy', $produto->id) }}"
                                                                            novalidate>
                                                                            @method('DELETE')
                                                                            @CSRF
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Excluir</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="p-3 d-flex justify-content-center align-items-center"> <i>Nenhum registro
                                            encontrado</i></div>
                                @endif
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </section>
    </main>

    <div class="modal fade" id="modalProdutos" tabindex="-1" role="dialog" aria-labelledby="modalProdutosLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalProdutosLabel">Cadastro de produtos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <p class="text-danger">* Campo obrigatório</p>
                <div class="modal-body">
                    <form method="POST" class="form-template" action="{{ route('produto.store') }}">
                        @csrf
                        <div class="form-group">
                            <div class="row mb-4">
                                <div class="form-group col-md-12">
                                    <div class="floating-label">
                                        <input type="text" name="nome" id="nome"
                                            class="form-control @error('nome') is-invalid @enderror" autocomplete="nome"
                                            value="{{ old('nome') }}" />
                                        <label for="nome">Nome <abbr title="campo obrigatório"
                                                class="text-danger">*</abbr></label>
                                        @error('nome')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            <script>
                                                $(document).ready(function() {
                                                    $('#modalProdutos').modal('show');
                                                });
                                            </script>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="form-group col-md-12">
                                    <div class="floating-label">
                                        <input type="number" step="0.01" name="valor" id="valor"
                                            class="form-control @error('valor') is-invalid @enderror"
                                            value="{{ old('valor') }}" />
                                        <label for="valor">Valor (R$0,00) <abbr title="campo obrigatório"
                                                class="text-danger">*</abbr></label>
                                        @error('valor')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            <script>
                                                $(document).ready(function() {
                                                    $('#modalProdutos').modal('show');
                                                });
                                            </script>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-group form-button d-flex justify-content-around">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn custon-button">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('.modal .modal-footer .btn-default').on('click', function() {
                    $(this).closest('.modal').modal('hide');
                });
                $('.modal .modal-header .close').on('click', function() {
                    $(this).closest('.modal').modal('hide');
                });
            });
        </script>
    @endpush
@endsection
