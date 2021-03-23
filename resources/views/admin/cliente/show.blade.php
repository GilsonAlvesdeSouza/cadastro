@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-white bg-secondary mb-3" >
                <div class="card-header">{{ __('Dados de Clientes') }}</div>

                <div class="card-body" >
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <div class="card">
                            <div class="card-header" style="color: #1b1e21">
                                <h1>{{ $cliente->nome }}</h1>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title" style="color: #1b1e21">Cidade: {{ $cliente->cidade->cidade }}</h5>
                                <p class="card-text" style="color: #1b1e21">Criado em: {{ $cliente->created_at }} - Atualizado em: {{ $cliente->updated_at }}</p>
                                <a href="{{ route('admin.clientes.index') }}" class="btn btn-primary">Voltar</a>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
