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
                    <form method="POST" class="form-template" action="{{ route('venda.store') }}">
                        @CSRF
                        <div class="form-group">
                            <div class="row mb-5">
                                <div class="form-group col-md-12">
                                    <div class="floating-label">
                                        <select name="cliente_id" id="cliente_id"
                                            class="form-control @error('cliente_id') is-invalid @enderror" autofocus>
                                            <option value="" disabled {{ old('cliente_id') == '' ? 'selected' : '' }}>
                                                Selecione o Cliente</option>

                                            @foreach ($clientes as $cliente)
                                                <option value="{{ $cliente->id }}"
                                                    {{ old('cliente_id') == 'cliente_id' ? 'selected' : '' }}>
                                                    {{ $cliente->nome }}</option>
                                            @endforeach
                                        </select>

                                        <label for="cliente_id">Cliente <abbr title="campo obrigatório"
                                                class="text-danger">*</abbr></label>
                                        @error('cliente_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>

                            </div>
                            <h3 class="mb-5"> Itens</h3>
                            <div class="row mb-5">
                                <div class="form-group col-md-3">
                                    <div class="floating-label">
                                        <select name="produto_id" id="produto_id"
                                            class="form-control @error('produto_id') is-invalid @enderror" autofocus>
                                            <option value="" disabled {{ old('produto_id') == '' ? 'selected' : '' }}>
                                                Selecione o Produto</option>
                                            @foreach ($produtos as $produto)
                                                <option value="{{ $produto->id }}" data-valor="{{ $produto->valor }}">
                                                    {{ $produto->nome }}</option>
                                            @endforeach
                                        </select>
                                        <label for="produto_id">Produto <abbr title="campo obrigatório"
                                                class="text-danger">*</abbr></label>
                                        @error('produto_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <div class="floating-label">
                                        <input type="number" name="quantidade_produto" id="quantidade_produto"
                                            class="form-control @error('quantidade_produto') is-invalid @enderror"
                                            value="{{ old('quantidade_produto') }}" />
                                        <label for="quantidade_produto">Quantidade<abbr title="campo obrigatório"
                                                class="text-danger">*</abbr></label>
                                        @error('quantidade_produto')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <div class="floating-label">
                                        <input type="number" step="0.01" name="valor" id="valor"
                                            class="form-control @error('valor') is-invalid @enderror"
                                            value="{{ old('valor') }}" readonly />
                                        <label for="valor">Valor Unitário<abbr title="campo obrigatório"
                                                class="text-danger">*</abbr></label>
                                        @error('valor')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-2">
                                    <div class="floating-label">
                                        <input type="number" step="0.01" name="subtotal" id="subtotal"
                                            class="form-control @error('subtotal') is-invalid @enderror"
                                            value="{{ old('subtotal') }}" readonly />
                                        <label for="subtotal">Subtotal<abbr title="campo obrigatório"
                                                class="text-danger">*</abbr></label>
                                        @error('subtotal')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <a id="addproduto" class="btn custon-button"
                                    style="width: 50px;height: 50px; margin-left:20px"><i class="fas fa-plus"></i></a>
                            </div>
                            <div class="card card-secondary card-outline tabela-despesas">
                                <div class="card-body table-responsive p-0">

                                    <table class="table table-bordered table-striped table-sm dataTable dtr-inline">
                                        <thead>
                                            <tr>
                                                <th colspan="7" style="text-align: center">Produtos</th>
                                            </tr>
                                            <tr>
                                                <th>Item</th>
                                                <th>Id do Produto</th>
                                                <th>Nome</th>
                                                <th>Quantidade</th>
                                                <th>Valor</th>
                                                <th>Subtotal</th>
                                                <th style="width: 1%;">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody id="listaprodutos">


                                        </tbody>
                                    </table>

                                </div>

                            </div>

                            <div class="form-group form-button">
                                <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn custon-button-2">Voltar</a>
                                <button type="submit" class="btn custon-button">Finalizar Venda</button>
                            </div>
                        </div>
                </div>
                </form>
            </div>
            </div>

        </section>
    </main>

    @push('scripts')
        <script>
            var produtoId = document.getElementById('produto_id');
            var quantidade = document.getElementById('quantidade_produto');
            var valorUnitario = document.getElementById('valor');
            var subtotal = document.getElementById('subtotal');

            produtoId.addEventListener('change', function() {
                let selectedOption = this.options[this.selectedIndex];
                let valor = selectedOption.getAttribute('data-valor');
                valorUnitario.value = valor;
                calcularSubtotal();
            });

            quantidade.addEventListener('input', function() {
                calcularSubtotal();
            });

            valorUnitario.addEventListener('input', function() {
                calcularSubtotal();
            });

            function calcularSubtotal() {
                let valorUnitario = parseFloat(document.getElementById('valor').value);
                let quantidade = parseFloat(document.getElementById('quantidade_produto').value);
                let subtotal = valorUnitario * quantidade;
                document.getElementById('subtotal').value = subtotal.toFixed(2);
            }

            document.getElementById('addproduto').addEventListener('click', function() {
                var produtoId = document.getElementById('produto_id').value;
                var quantidade = document.getElementById('quantidade_produto').value;
                var valorUnitario = document.getElementById('valor').value;
                var subtotal = document.getElementById('subtotal').value;

                var objeto = {
                    produto_id: produtoId,
                    quantidade_produto: quantidade,
                    valor: valorUnitario,
                    subtotal: subtotal
                };
                
                var produtosSelecionados = JSON.parse(localStorage.getItem('produtosSelecionados')) || [];
                produtosSelecionados.push(objeto);
                localStorage.setItem('produtosSelecionados', JSON.stringify(produtosSelecionados));

                document.getElementById('produto_id').value = '';
                document.getElementById('quantidade_produto').value = '';
                document.getElementById('valor').value = '';
                document.getElementById('subtotal').value = '';
                console.log(produtosSelecionados);


                let tr = document.createElement('tr');

                let nomeproduto = document.createElement('td');

                nomeproduto.textContent = produtoId;

                tr.appendChild(nomeproduto);

                let quantidadeproduto = document.createElement('td');
                quantidadeproduto.textContent = quantidade;
                tr.appendChild(quantidadeproduto);

                let valor = document.createElement('td');
                valor.textContent = valorUnitario;
                tr.appendChild(valor);

                let subtotalproduto = document.createElement('td');
                subtotalproduto.textContent = subtotal;
                tr.appendChild(subtotalproduto);

                document.querySelector('#listaprodutos').appendChild(tr);
            });
        </script>
    @endpush
@endsection
