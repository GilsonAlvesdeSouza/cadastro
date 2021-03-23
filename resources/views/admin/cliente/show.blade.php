@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-white bg-secondary mb-3" >
                <div class="card-header">{{ __('Cadastro de Clientes') }}</div>

                <div class="card-body" style="height: 30em">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Seja bem vindo!') }}
                        <h2><a href="{{ route('admin.clientes.index') }}">Listar Usuários</a></h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
