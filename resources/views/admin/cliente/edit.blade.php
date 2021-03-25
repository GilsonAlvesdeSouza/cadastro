@extends('layouts.app')

@section('content')
    @php
        if($errors->all())
               toast($errors->all()[0], 'error');
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-white bg-secondary mb-3" >
                    <div class="card-header">{{ __('Cadastrar Cliente') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('admin.clientes.update', $cliente->codigo) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Nome</label>
                                    <input type="text" name="nome" class="form-control" id="name" placeholder="Nome Completo"
                                    value="{{ @old('nome') ?? $cliente->nome }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="cidade">Cidade</label>
                                    <input type="Text" class="form-control" name="cidade" id="cidade"
                                           placeholder="Cidade" value="{{ old('cidade') ?? $cliente->cidade->cidade }}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Editar</button>
                            <a class="btn btn-warning" href="{{ route('admin.clientes.index') }}" style="margin-left: 10px">Listar todos</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
