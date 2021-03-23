<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClienteRequest;
use App\Model\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('admin.cliente.list', [
            'clientes' => $clientes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteRequest $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param $clientes
     * @return \Illuminate\Http\Response
     */
    public function show($clientes)
    {

        $cliente = Cliente::find($clientes)->first();

        $cidade = $cliente->cidade()->first();

        echo "Nome: $cliente->nome<br>";
        echo "cidade: $cidade->cidade <br>";

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Cliente  $clientes
     * @return \Illuminate\Http\Response
     */
    public function edit($clientes)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Cliente  $clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $clientes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Cliente  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $clientes)
    {
        //
    }
}
