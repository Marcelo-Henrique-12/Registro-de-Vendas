<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $clientes = $user->clientes;
        return view('clientes.index',['clientes'=>$clientes]);
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
    public function store(ClienteRequest $request)
    {
        $dados = $request->validated();
        $user = Auth::user();
        $dados['user_id'] = $user->id;

        Cliente::create($dados);

        return redirect()->route('cliente.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        $cliente = Cliente::findOrFail($id);

        if ($cliente->user_id != $user->id) {
            return redirect()->route('cliente.index')->with('error', 'Acesso negado!');
        }

        return view('clientes.edit', ['cliente' => $cliente]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClienteRequest $request, string $id)
    {
        $user = Auth::user();
        $cliente = Cliente::findOrFail($id);

        if ($cliente->user_id != $user->id) {
            return redirect()->route('cliente.index')->with('error', 'Acesso negado!');
        }

        $cliente->update($request->validated());
        return redirect()->route('cliente.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        $cliente = Cliente::findOrFail($id);

        if ($cliente->user_id != $user->id) {
            return redirect()->route('cliente.index')->with('error', 'Acesso negado!');
        }

        $cliente->delete();
        return redirect()->route('cliente.index')->with('success', 'Cliente excluído com sucesso!');
    }
}
