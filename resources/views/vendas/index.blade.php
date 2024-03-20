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
                        <h5 class="modal-title" id="modalGanhosLabel">Cadastrar Venda</h5>
                        <p class="text-danger">* Campo obrigatório</p>
                    </div>
                    <hr>
                    <h3 class="mt-5 mb-4">Registros</h3>
                    <div class="registros-section ">

                        <div class="card card-secondary card-outline">
                            <div class="card-body table-responsive table-responsive-xl p-0">
                                @if ($vendas->count() > 0)
                                    <table class="table table-bordered table-striped table-sm dataTable dtr-inline">
                                        <thead>
                                            <tr>
                                                <th colspan="5" style="text-align: center">Vendas</th>
                                            </tr>
                                            <tr>
                                                <th>Id</th>
                                                <th>Usuário que Realizou</th>
                                                <th>Valor Total</th>
                                                <th>Data</th>
                                                <th style="width: 5%;">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($vendas as $venda)
                                                <tr>
                                                    <td>{{ $venda->id }}</td>
                                                    <td>{{ $venda->user->name }}</td>
                                                    <td>R$ {{ $venda->total }}</td>
                                                    <td>{{ $venda->created_at->format('d/m/Y') }}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="{{ route('venda.edit', $venda->id) }}" type="button"
                                                                class="btn btn-primary" title="Editar">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                            <a href="{{ route('venda.show', $venda->id) }}" type="button"
                                                                class="btn btn-secondary" title="Visualizar">
                                                                <i class="fas fa-eye"></i>
                                                            </a>

                                                            <button type="button" class="btn btn-danger"
                                                                data-toggle="modal"
                                                                data-target="#modal-default{{ $venda->id }}"
                                                                title="Excluir">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>

                                                        </div>
                                                        <div class="modal fade" id="modal-default{{ $venda->id }}"
                                                            style="display: none;" aria-hidden="true" data-backdrop="static"
                                                            data-keyboard="false">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Excluir Venda</h4>
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
                                                                            action="{{ route('venda.destroy', $venda->id) }}"
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

@endsection
