<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoRequest;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $produtos = $user->produtos;
        return view('produtos.index', ['produtos' => $produtos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProdutoRequest $request)
    {
        $dados = $request->validated();
        $user = Auth::user();
        $dados['user_id'] = $user->id;

        Produto::create($dados);

        return redirect()->route('produto.index')->with('success', 'Produto cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        $produto = Produto::findOrFail($id);

        if ($produto->user_id != $user->id) {
            return redirect()->route('produto.index')->with('error', 'Acesso negado!');
        }

        return view('produtos.edit', ['produto' => $produto]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProdutoRequest $request, string $id)
    {
        $user = Auth::user();
        $produto = Produto::findOrFail($id);

        if ($produto->user_id != $user->id) {
            return redirect()->route('produto.index')->with('error', 'Acesso negado!');
        }

        $produto->update($request->validated());
        return redirect()->route('produto.index')->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        $produto = Produto::findOrFail($id);

        if ($produto->user_id != $user->id) {
            return redirect()->route('produto.index')->with('error', 'Acesso negado!');
        }

        $produto->delete();
        return redirect()->route('produto.index')->with('success', 'Produto excluído com sucesso!');
    }

}
