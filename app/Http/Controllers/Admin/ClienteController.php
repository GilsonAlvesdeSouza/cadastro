<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClienteRequest;
use App\Model\Cidade;
use App\Model\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $clientes = DB::table('clientes')->paginate(1);

        $clientes = Cliente::orderBy('nome', 'asc')->paginate(5);
        return view('admin.cliente.list', [
            'clientes' => $clientes,
//            'pag' => $pag
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $data = $request->only([
                    'cidade',
                ]);

                $cliente = $request->only([
                    'nome',
                ]);

                $cidade = Cidade::create($data);

                $cliente['codigoCidade'] = $cidade->codigo;

                Cliente::create($cliente);

            });

        } catch (\Exception $e) {
            toast('Ocorreu um erro ao tenatr salvar o cliente!' + $e, 'success');
            return redirect()->route('admin.clientes.create');
        }
        toast('Cliente salvo com sucesso!', 'success');
        return redirect()->route('admin.clientes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param $clientes
     * @return \Illuminate\Http\Response
     */
    public function show($clientes)
    {
        $cliente = Cliente::Where('codigo', $clientes)->first();

        return view('admin.cliente.show', ['cliente' => $cliente]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit($cliente)
    {
        $cliente = Cliente::where('codigo', $cliente)->first();
        return view('admin.cliente.edit', [
            'cliente' => $cliente,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteRequest $request, $cliente)
    {
        try {
            DB::transaction(function () use ($request, $cliente) {
                $cliente = Cliente::where('codigo', $cliente)->first();
                $cliente->nome = $request->nome;
                $cliente->saveCidade($request->cidade);
                $cliente->save();
            });
        } catch (\Exception $e) {
            toast('Ocorreu um erro ao tenatr editar o cliente!' + $e, 'success');
            return redirect()->route('admin.clientes.index');
        }
        toast('Cliente editado com sucesso!', 'success');
        return redirect()->route('admin.clientes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($cliente)
    {
        try {
            DB::transaction(function () use ($cliente) {
                $clienteExcluir = Cliente::where('codigo', $cliente)->first();
                $cidade = Cidade::where('codigo', $clienteExcluir->codigoCidade)->first();
                $clienteExcluir->delete();
                $cidade->delete();
            });
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Ocorreu um erro ao excluir o cliente...' + e]);
        }
        return response()->json(['msg' => 'Cliente excluído com sucesso..']);
    }

    /**
     * Method for listing items in the trash
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trashed()
    {
        $clientes = Cliente::onlyTrashed()->paginate();

        return view('admin.cliente.trashed', [
            'clientes' => $clientes,
        ]);
    }

    /**
     * Method to restore item from trash
     *
     * @param $cliente
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($cliente)
    {
        $cliente = Cliente::onlyTrashed()->where('codigo', $cliente)->first();
        $cidade = Cidade::onlyTrashed()->where('codigo', $cliente->codigoCidade)->first();

        if ($cliente->trashed() && $cidade->trashed()) {
            $cliente->restore();
            $cidade->restore();
        }

        return redirect()->route('admin.clientes.trashed');
    }

    /**
     * Method for deleting item from trash
     *
     * @param $cliente
     * @return \Illuminate\Http\JsonResponse
     */
    public function forceDelete($cliente)
    {
        $cliente = Cliente::onlyTrashed()->where('codigo', $cliente)->first();
        $cidade = Cidade::onlyTrashed()->where('codigo', $cliente->codigoCidade)->first();

        if ($cliente->trashed() && $cidade->trashed()) {
            try {
                DB::transaction(function () use ($cidade) {
                    $cidade->forceDelete();
                });
            } catch (\Exception $e) {
                return response()->json(['msg' => 'Ocorreu um erro ao excluir o cliente...' + e]);
            }
        return response()->json(['msg' => 'Cliente excluído com sucesso..']);
        }
    }
}
