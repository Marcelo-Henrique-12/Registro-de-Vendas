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

                                        <label for="cliente_id">Cliente </label>
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
                                                <option value="{{ $produto->id }}" data-valor="{{ $produto->valor }}"
                                                    data-nome="{{ $produto->nome }}">
                                                    {{ $produto->nome }}</option>
                                            @endforeach
                                        </select>
                                        <label for="produto_id">Produto <abbr title="campo obrigatório"
                                                class="text-danger">*</abbr></label>
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <div class="floating-label">
                                        <input type="number" name="quantidade_produto" id="quantidade_produto"
                                            class="form-control @error('quantidade_produto') is-invalid @enderror"
                                            value="{{ old('quantidade_produto') }}" />
                                        <label for="quantidade_produto">Quantidade<abbr title="campo obrigatório"
                                                class="text-danger">*</abbr></label>
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <div class="floating-label">
                                        <input type="number" step="0.01" name="valor" id="valor"
                                            class="form-control @error('valor') is-invalid @enderror"
                                            value="{{ old('valor') }}" readonly />
                                        <label for="valor">Valor Unitário<abbr title="campo obrigatório"
                                                class="text-danger">*</abbr></label>
                                    </div>
                                </div>

                                <div class="form-group col-md-2">
                                    <div class="floating-label">
                                        <input type="number" step="0.01" name="subtotal" id="subtotal"
                                            class="form-control @error('subtotal') is-invalid @enderror"
                                            value="{{ old('subtotal') }}" readonly />
                                        <label for="subtotal">Subtotal<abbr title="campo obrigatório"
                                                class="text-danger">*</abbr></label>
                                    </div>
                                </div>
                                <a id="addproduto" class="btn custon-button"
                                    style="width: 50px;height: 50px; margin-left:20px"><i class="fas fa-plus"></i></a>
                            </div>

                            <div class="card card-secondary card-outline" id="produtosSelecionados">
                                <div class="card-body table-responsive p-0">

                                    <table class="table table-bordered table-striped table-sm dataTable dtr-inline">
                                        <thead>
                                            <tr>
                                                <th colspan="7" style="text-align: center">Produtos</th>
                                            </tr>
                                            <tr>
                                                <th>Id do Produto</th>
                                                <th>Nome</th>
                                                <th>Quantidade</th>
                                                <th>Valor</th>
                                                <th>Subtotal</th>
                                                <th style="width: 10%;" colspan="2">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody id="listaprodutos">


                                        </tbody>

                                    </table>

                                </div>
                                <div id="inputsProdutosTotais"></div>
                            </div>
                            @error('produtos')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            {{-- Pagamento --}}

                            <h3 class="mb-5 mt-5"> Pagamento</h3>
                            <div class="row mb-5">
                                <div class="form-group col-md-4">
                                    <div class="floating-label">
                                        <input type="number" name="quantidade_parcelas" id="quantidade_parcelas"
                                            class="form-control @error('quantidade_parcelas') is-invalid @enderror"
                                            value="{{ old('quantidade_parcelas') }}" />
                                        <label for="quantidade_parcelas">Quantidade de Parcelas<abbr
                                                title="campo obrigatório" class="text-danger">*</abbr></label>
                                        @error('quantidade_parcelas')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <a id="createparcelas" class="btn custon-button"
                                    style="width: 50px;height: 50px; margin-left:20px"><i class="fas fa-plus"></i></a>

                            </div>

                            <div id="listaparcelas">

                                {{-- Scafolding para plotar: --}}

                                {{-- <div class="row mb-5 d-flex align-items-center">
                                    <div id="createparcelas"
                                        class="btn custon-button d-flex align-items-center justify-content-center"
                                        style="width: 50px;height: 50px; margin-left:20px">Número parcela</div>

                                    <div class="form-group col-md-3">
                                        <div class="floating-label">
                                            <input type="date" name="data_parcela" id="data_parcela"
                                                class="form-control @error('data_parcela') is-invalid @enderror"
                                                value="{{ old('data_parcela') }}" />
                                            <label for="data_parcela">Data></label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <div class="floating-label">
                                            <input type="number" name="valor_parcela" id="valor_parcela"
                                                class="form-control @error('valor_parcela') is-invalid @enderror"
                                                value="{{ old('valor_parcela') }}" />
                                            <label for="valor_parcela">Valor Parcela</label>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>

                            <div class="form-group form-button mt-5">
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
            window.addEventListener('beforeunload', function(event) {

                localStorage.removeItem('produtosSelecionados');
                localStorage.removeItem('parcelas');
            });
            document.addEventListener('DOMContentLoaded', function() {
                localStorage.removeItem('produtosSelecionados');
                localStorage.removeItem('parcelas');
                var produtosSelecionados = JSON.parse(localStorage.getItem('produtosSelecionados')) || [];
                atualizaTabela(produtosSelecionados);
            });
            var produto = document.getElementById('produto_id');
            var quantidade = document.getElementById('quantidade_produto');
            var valorUnitario = document.getElementById('valor');
            var subtotal = document.getElementById('subtotal');

            produto.addEventListener('change', function() {
                let produtoSelecionado = this.options[this.selectedIndex];
                let valor = produtoSelecionado.getAttribute('data-valor');
                var produtoNome = produtoSelecionado.getAttribute('data-nome');
                valorUnitario.value = valor;
                quantidade.value = 1;
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
                var produto = document.getElementById('produto_id');
                let produtoSelecionado = produto.options[produto.selectedIndex];
                var produtoId = produto.value;
                var produtoNome = produtoSelecionado.getAttribute('data-nome');

                var quantidade = document.getElementById('quantidade_produto').value;
                var valorUnitario = document.getElementById('valor').value;
                var subtotal = document.getElementById('subtotal').value;

                var detalhesProduto = {
                    produto_id: produtoId,
                    produto_nome: produtoNome,
                    quantidade_produto: quantidade,
                    valor: valorUnitario,
                    subtotal: subtotal
                };

                var produtosSelecionados = JSON.parse(localStorage.getItem('produtosSelecionados')) || [];
                produtosSelecionados.push(detalhesProduto);
                localStorage.setItem('produtosSelecionados', JSON.stringify(produtosSelecionados));
                document.getElementById('produto_id').value = '';
                document.getElementById('quantidade_produto').value = '';
                document.getElementById('valor').value = '';
                document.getElementById('subtotal').value = '';


                atualizaTabela(produtosSelecionados);


            });

            function atualizaTabela(produtosSelecionados) {
                document.querySelector('#listaprodutos').innerHTML = '';

                var produtosCompra = [];

                produtosSelecionados.forEach((element, index) => {
                    let tr = document.createElement('tr');

                    let idproduto = document.createElement('td');
                    idproduto.textContent = element.produto_id;
                    tr.appendChild(idproduto);

                    let nomeProduto = document.createElement('td');
                    nomeProduto.textContent = element.produto_nome;
                    tr.appendChild(nomeProduto);


                    let linhaquantidadeproduto = document.createElement('td');
                    let inputQuantidade = document.createElement('input');
                    inputQuantidade.setAttribute('type', 'number');
                    inputQuantidade.setAttribute('name', 'quantidade_produto');
                    inputQuantidade.setAttribute('class', 'text-center');
                    inputQuantidade.setAttribute('disabled', 'disabled');
                    inputQuantidade.value = element.quantidade_produto;
                    let inputQuantidadeId = 'quantidade_produto_' + index;
                    inputQuantidade.setAttribute('id', inputQuantidadeId);
                    linhaquantidadeproduto.appendChild(inputQuantidade);
                    tr.appendChild(linhaquantidadeproduto);


                    let linhaValor = document.createElement('td');
                    let inputValor = document.createElement('input');
                    inputValor.setAttribute('type', 'number');
                    inputValor.setAttribute('name', 'valor');
                    inputValor.setAttribute('step', '0.01');
                    inputValor.setAttribute('class', 'text-center');
                    inputValor.setAttribute('readonly', 'readonly');
                    inputValor.setAttribute('disabled', 'disabled');
                    inputValor.value = element.valor;

                    let inputValorId = 'valor_' + index;
                    inputValor.setAttribute('id', inputValorId);

                    linhaValor.appendChild(inputValor);
                    tr.appendChild(linhaValor);




                    let subtotalproduto = document.createElement('td');
                    subtotalproduto.textContent = element.subtotal;
                    tr.appendChild(subtotalproduto);


                    let excluirIcone = document.createElement('td');
                    let excluirBotao = document.createElement('div');
                    excluirBotao.innerHTML = '<i class="fas fa-trash-alt" style="cursor:pointer;"></i>';

                    excluirBotao.addEventListener('click', function() {
                        excluirItem(index)
                    });

                    excluirIcone.appendChild(excluirBotao);
                    tr.appendChild(excluirIcone);

                    document.querySelector('#listaprodutos').appendChild(tr);

                    produtosCompra.push({
                        produto_id: element.produto_id,
                        produto_nome: element.produto_nome,
                        quantidade_produto: element.quantidade_produto,
                        valor: element.valor,
                        subtotal: element.subtotal
                    });

                });
                var produtosJson = JSON.stringify(produtosCompra);

                var inputProdutos = document.createElement('input');
                inputProdutos.type = 'hidden';
                inputProdutos.name = 'produtos';
                inputProdutos.value = produtosJson;

                var total = 0

                produtosCompra.forEach(element => {
                    total += parseFloat(element.subtotal);
                });

                var inputTotal = document.createElement('input');
                inputTotal.type = 'hidden';
                inputTotal.name = 'total';
                inputTotal.value = total;


                var divTotal = document.createElement('div');
                divTotal.textContent = 'Total: R$ ' + total.toFixed(2);

                var inputsProdutosTotais = document.querySelector('#inputsProdutosTotais');
                inputsProdutosTotais.innerHTML = '';


                inputsProdutosTotais.appendChild(inputProdutos);
                inputsProdutosTotais.appendChild(inputTotal);
                inputsProdutosTotais.appendChild(divTotal);

                var quantidadeParcelas = document.querySelector('#quantidade_parcelas');
                if (quantidadeParcelas) {
                    parcelar(total, quantidadeParcelas.value);
                }


            }

            function excluirItem(index) {
                var produtosSelecionados = JSON.parse(localStorage.getItem('produtosSelecionados')) || [];
                produtosSelecionados.splice(index, 1);
                localStorage.setItem('produtosSelecionados', JSON.stringify(produtosSelecionados));
                atualizaTabela(produtosSelecionados);
            }


            document.getElementById('createparcelas').addEventListener('click', function() {
                var produtosSelecionados = JSON.parse(localStorage.getItem('produtosSelecionados'));
                var quantidadeParcelas = document.querySelector('#quantidade_parcelas');
                var total = calculartotal(produtosSelecionados);
                parcelar(total, quantidadeParcelas.value);

            });

            function calculartotal(produtos) {
                var total = 0
                produtos.forEach(element => {
                    total += parseFloat(element.subtotal);
                });
                return total;
            }

            function parcelar(total, quantidade) {

                valorInicialParcela = (total / quantidade).toFixed(2);
                var parcelas = [];
                var hoje = new Date();
                var proximoMes = new Date(hoje.getFullYear(), hoje.getMonth() + 1, 1);

                for (i = 0; i < quantidade; i++) {

                    var dataParcela = new Date(proximoMes.getFullYear(), proximoMes.getMonth() + i, 1);

                    var detalheParcela = {
                        numero_parcela: i + 1,
                        data_parcela: dataParcela.toLocaleDateString(),
                        valor_parcela: valorInicialParcela,
                    };
                    parcelas.push(detalheParcela);
                }
                imprimeParcelas(parcelas);
            }

            function atualizarParcelas(total, parcelas, index, valorNovo, quantidade) {

                var valorAcumulado = 0;
                var itemAtual = parseFloat(index) + 1;

                parcelas.forEach((element, index) => {
                    if (index < (itemAtual - 1) && itemAtual != 1) {
                        valorAcumulado += parseFloat(element.valor_parcela);
                    }
                });

                var valorRestante = parseFloat(total) - valorAcumulado;

                if (valorNovo > valorRestante) {
                    valorNovo = valorRestante;
                }

                var totalRestante = parseFloat(total) - parseFloat(valorNovo) - valorAcumulado;
                var quantidadeRestante = parseFloat(quantidade) - itemAtual;
                var divisaoRestante = (totalRestante / quantidadeRestante).toFixed(2);

                console.log(totalRestante);
                parcelas.forEach((element, index) => {
                    if (index > (itemAtual - 1)) {
                        element.valor_parcela = divisaoRestante;
                    }
                    if (index == (itemAtual - 1)) {
                        element.valor_parcela = valorNovo;
                    }
                });
                imprimeParcelas(parcelas);
            }

            function imprimeParcelas(parcelas) {
                var listaParcelas = document.querySelector('#listaparcelas');
                listaParcelas.innerHTML = '';

                var parcelamento = [];

                parcelas.forEach((element, index) => {

                    var divParcela = document.createElement('div');
                    divParcela.classList.add('row', 'mb-5', 'd-flex', 'align-items-center');

                    // campo do número da parcela
                    var numeroParcela = document.createElement('div');
                    numeroParcela.textContent = element.numero_parcela;
                    numeroParcela.classList.add('btn', 'custon-button', 'd-flex', 'align-items-center',
                        'justify-content-center');
                    numeroParcela.style.width = '50px';
                    numeroParcela.style.height = '50px';
                    numeroParcela.style.marginLeft = '20px';
                    divParcela.appendChild(numeroParcela);


                    // campo input da data da parcela
                    var campoDataParcela = document.createElement('div');
                    campoDataParcela.classList.add('form-group', 'col-md-3');
                    var divFloatingLabelData = document.createElement('div');
                    divFloatingLabelData.classList.add('floating-label');
                    var inputDataParcela = document.createElement('input');
                    inputDataParcela.setAttribute('type', 'date');
                    inputDataParcela.setAttribute('name', 'data_parcela_' + element.numero_parcela);
                    inputDataParcela.setAttribute('id', 'data_parcela_' + element.numero_parcela);
                    inputDataParcela.classList.add('form-control');
                    inputDataParcela.classList.add('text-center');
                    inputDataParcela.valueAsDate = new Date(element.data_parcela);
                    var labelDataParcela = document.createElement('label');
                    labelDataParcela.setAttribute('for', 'data_parcela_' + element.numero_parcela);
                    labelDataParcela.textContent = 'Data';
                    divFloatingLabelData.appendChild(inputDataParcela);
                    divFloatingLabelData.appendChild(labelDataParcela);
                    campoDataParcela.appendChild(divFloatingLabelData);
                    divParcela.appendChild(campoDataParcela);


                    var campoValorParcela = document.createElement('div');
                    campoValorParcela.classList.add('form-group', 'col-md-3');
                    var divFloatingLabelValor = document.createElement('div');
                    divFloatingLabelValor.classList.add('floating-label');
                    var inputValorParcela = document.createElement('input');
                    inputValorParcela.setAttribute('type', 'number');
                    inputValorParcela.setAttribute('name', 'valor_parcela_' + element.numero_parcela);
                    inputValorParcela.setAttribute('id', 'valor_parcela_' + element.numero_parcela);
                    inputValorParcela.setAttribute('step', '0.01');
                    inputValorParcela.classList.add('form-control');
                    inputValorParcela.classList.add('text-center');
                    inputValorParcela.value = element.valor_parcela;
                    var labelValorParcela = document.createElement('label');
                    labelValorParcela.setAttribute('for', 'valor_parcela');
                    labelValorParcela.textContent = 'Valor Parcela ';
                    divFloatingLabelValor.appendChild(inputValorParcela);
                    divFloatingLabelValor.appendChild(labelValorParcela);
                    campoValorParcela.appendChild(divFloatingLabelValor);
                    divParcela.appendChild(campoValorParcela);

                    inputValorParcela.addEventListener('change', function(event) {
                        var valorNovo = parseFloat(event.target.value);
                        var produtosSelecionados = JSON.parse(localStorage.getItem('produtosSelecionados'));
                        var total = calculartotal(produtosSelecionados);
                        var quantidadeParcelas = document.querySelector('#quantidade_parcelas').value;

                        if (valorNovo > total) {
                            event.target.value = total.toFixed(2);
                            valorNovo = total;
                        }

                        atualizarParcelas(total, parcelas, index, valorNovo, quantidadeParcelas);
                    });
                    listaParcelas.appendChild(divParcela);

                    parcelamento.push({
                        data_parcela: element.data_parcela,
                        valor_parcela: element.valor_parcela,
                    });

                });
                var parcelamentoJson = JSON.stringify(parcelamento);

                var inputParcelas = document.createElement('input');
                inputParcelas.type = 'hidden';
                inputParcelas.name = 'parcelas';
                inputParcelas.value = parcelamentoJson;

                var parcelamentoSelecionado = document.querySelector('#listaparcelas');
                parcelamentoSelecionado.appendChild(inputParcelas);
            }
        </script>
    @endpush
@endsection
