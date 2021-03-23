@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-header">Listagem Cliente</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h2>{{ __('Lista dos Usuários') }}</h2>
                            <table class="table table-bordered table-dark">
                                <thead>
                                <tr>
                                    <th scope="col">Cliente</th>
                                    <th scope="col">Cidade</th>
                                    <th scope="col">Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($clientes)
                                @foreach($clientes as $cliente)
                                    <tr>
                                        <td><a href="{{ route('admin.clientes.show', $cliente->codigo) }}">{{ $cliente->nome }}</a></td>
                                        <td>{{ $cliente->cidade->cidade }}</td>
                                        <td style="width: 13em">
                                            <a href="{{ route('admin.clientes.edit',  $cliente->codigo) }}" class="btn btn-info" style="margin-right: 1em">Editar</a>
                                            <button class="btn btn-danger">Excluir</button>
                                        </td>
                                    </tr>
                                @endforeach
                                @endif
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
