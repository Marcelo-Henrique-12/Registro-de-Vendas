<?php

namespace App\Http\Controllers;

use App\Models\Parcela;
use App\Models\Venda;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VendaController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $vendas = $user->vendas;

        return view('vendas.index', [
            'vendas' => $vendas,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $clientes = $user->clientes;
        $produtos = $user->produtos;

        return view('vendas.create', [
            'clientes' => $clientes,
            'produtos' => $produtos,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $produtos = json_decode($request->produtos, true);
        $parcelas = json_decode($request->parcelas, true);

        $request->merge([
            'produtos' => $produtos,
            'parcelas' => $parcelas,
        ]);

        $validator = Validator::make($request->all(), [
            'quantidade_parcelas' => 'required|numeric|min:1',
            'total' => 'required|numeric|min:0',
            'produtos' => 'required|array|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();

        return DB::transaction(function () use ($request, $user) {
            $venda_dados['total'] = $request->total;
            $venda_dados['user_id'] = $user->id;

            if ($request->has('cliente_id')) {
                $venda_dados['cliente_id'] = $request->cliente_id;
            }

            $venda = Venda::create($venda_dados);

            foreach ($request->produtos as $produto) {
                $venda->produtos()->attach($produto['produto_id'], ['quantidade' => $produto['quantidade_produto']]);
            }

            foreach ($request->parcelas as $index => $parcela) {
                $dados_parcela = [];
                $dados_parcela['quantidade'] = $request->quantidade_parcelas;
                $dados_parcela['numero_parcela'] = $index + 1;
                $dados_parcela['valor'] = $parcela['valor_parcela'];
                $data_parcela_formatada = Carbon::createFromFormat('d/m/Y', $parcela['data_parcela'])->format('Y-m-d');
                $dados_parcela['data_vencimento'] = $data_parcela_formatada;
                $dados_parcela['venda_id'] = $venda->id;

                Parcela::create($dados_parcela);
            }



            return redirect()->route('venda.create')->with('success', 'Venda cadastrada com sucesso!');
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();
        $venda = Venda::where('user_id', $user->id)->FindOrFail($id);
        $clientes = $user->clientes;
        $produtos = $user->produtos;
        $quantidade_parcelas = $venda->parcelas->first()->quantidade;

        return view('vendas.show', [
            'venda' => $venda,
            'clientes' => $clientes,
            'produtos' => $produtos,
            'quantidade_parcelas' => $quantidade_parcelas,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        $venda = Venda::where('user_id', $user->id)->FindOrFail($id);
        $clientes = $user->clientes;
        $produtos = $user->produtos;
        $quantidade_parcelas = $venda->parcelas->first()->quantidade;

        return view('vendas.edit', [
            'venda' => $venda,
            'clientes' => $clientes,
            'produtos' => $produtos,
            'quantidade_parcelas' => $quantidade_parcelas,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $produtos = json_decode($request->produtos, true);
        $parcelas = json_decode($request->parcelas, true);

        $request->merge([
            'produtos' => $produtos,
            'parcelas' => $parcelas,
        ]);

        $validator = Validator::make($request->all(), [
            'quantidade_parcelas' => 'required|numeric|min:1',
            'total' => 'required|numeric|min:0',
            'produtos' => 'required|array|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();
        $venda = Venda::where('user_id', $user->id)->FindOrFail($id);
        return DB::transaction(function () use ($request, $user, $venda) {

            $venda_dados['total'] = $request->total;
            $venda_dados['user_id'] = $user->id;

            if ($request->has('cliente_id')) {
                $venda_dados['cliente_id'] = $request->cliente_id;
            }

            $venda->produtos()->detach();
            $venda->parcelas()->delete();

            $venda->update($venda_dados);

            foreach ($request->produtos as $produto) {
                $venda->produtos()->attach($produto['produto_id'], ['quantidade' => $produto['quantidade_produto']]);
            }

            foreach ($request->parcelas as $index => $parcela) {
                $dados_parcela = [];
                $dados_parcela['quantidade'] = $request->quantidade_parcelas;
                $dados_parcela['numero_parcela'] = $index + 1;
                $dados_parcela['valor'] = $parcela['valor_parcela'];
                $data_parcela_formatada = Carbon::createFromFormat('d/m/Y', $parcela['data_parcela'])->format('Y-m-d');
                $dados_parcela['data_vencimento'] = $data_parcela_formatada;
                $dados_parcela['venda_id'] = $venda->id;

                Parcela::create($dados_parcela);
            }



            return redirect()->route('venda.index')->with('success', 'Venda atualizada com sucesso!');
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        $venda = Venda::where('user_id', $user->id)->FindOrFail($id);
        $venda->produtos()->detach();
        $venda->parcelas()->delete();
        $venda->delete();
        return redirect()->route('venda.index')->with('success', 'Venda excluida com sucesso!');
    }

    
}
