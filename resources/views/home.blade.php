@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-header">{{ __('Cadastro de Clientes') }}</div>

                    <div class="card-body" style="height: 30em">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div style="text-align: center">
                            <h1 style="margin-bottom: 20px">{{ __('Seja bem vindo!') }}</h1>
                            <img src="{{url(asset('img/user.jpeg'))}}" alt="imagem padrão">
                            <h2 style="margin-top: 20px">{{ __('Sistema de cadastro de cliente!') }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
