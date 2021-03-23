@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('admin.clientes.store') }}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Nome</label>
                                    <input type="text" name="nome" class="form-control" id="name" placeholder="Nome Completo">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="cidade">Cidade</label>
                                    <input type="Text" class="form-control" name="cidade" id="cidade"
                                           placeholder="Cidade">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
