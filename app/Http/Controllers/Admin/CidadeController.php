<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Cidade;
use App\User;
use Illuminate\Http\Request;

class CidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd("teste");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd("teste");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Cidade  $codigo
     * @return \Illuminate\Http\Response
     */
    public function show($codigo)
    {
        $cidade = Cidade::where('codigo', $codigo)->first();
//        dd($cidade->getAttributes());
        echo "<h1> Dados da cidade <h1><br>";

        $cliente = $cidade->cliente()->get()->first();
        echo "Cidade: $cidade->cidade<br>";
        echo "Cliente: $cliente->nome";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Cidade  $cidades
     * @return \Illuminate\Http\Response
     */
    public function edit(Cidade $cidades)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Cidade  $cidades
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cidade $cidades)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Cidade  $cidades
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cidade $cidades)
    {
        //
    }
}
