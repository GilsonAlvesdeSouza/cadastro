@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-header"><h2>{{ __('Listagem de clientes') }}</h2></div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('admin.clientes.search') }}" method="post" style="margin-bottom: 20px">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Nome</label>
                                    <input type="text" name="nome" class="form-control" id="name"
                                           placeholder="Nome Cliente"
                                           value="{{ @old('nome') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="cidade">Cidade</label>
                                    <input type="Text" class="form-control" name="cidade" id="cidade"
                                           placeholder="Cidade" value="{{ old('cidade') }}">
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-warning">Pesquisar</button>
                                <a class="btn btn-warning" href="{{ route('admin.clientes.index') }}"
                                   style="margin-left: 10px">Listar todos</a>
                            </div>
                        </form>
                        <hr>
                        <div>
                            <a class="btn btn-primary" href="{{ route('admin.clientes.create') }}">Cadastrar</a>
                        </div>

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
                                        <td>
                                            <a href="{{ route('admin.clientes.show', $cliente->codigo) }}">{{ $cliente->nome }}</a>
                                        </td>
                                        @if($list === 1)
                                            <td>{{ $cliente->cidade }}</td>
                                        @else
                                            <td>{{ $cliente->cidade->cidade }}</td>
                                        @endif
                                        <td style="width: 13em">

                                            <a href="{{ route('admin.clientes.edit',  $cliente->codigo) }}"
                                               class="btn btn-info" style="margin-right: 1em">Editar</a>
                                            <button class="btn btn-danger btn-route-excluir"
                                                    value="{{ $cliente->codigo }}">Excluir
                                            </button>

                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        <div style="text-align: center; color: white;">
                            <a href="{{$clientes->previousPageUrl()}}" style="margin: 0px 15px 0 15px; color: white">Anterior</a>
                            {{$clientes->currentPage()}}
                            <a href="{{$clientes->nextPageUrl()}}"
                               style="margin: 0px 15px 0 15px; color: white">Proxímo</a>
                            @if($clientes->lastPage() == 1)
                                <p style="margin-bottom: 0px">{{$clientes->lastPage()}} Página</p>
                            @else
                                <p style="margin-bottom: 0px">{{$clientes->lastPage()}} Páginas</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.btn-route-excluir').click(function (e) {
                e.preventDefault();
                var id = $(this).closest('tr').find(this).val();

                Swal.fire({
                    title: 'Você tem certeza?',
                    text: "Mover para a lixeira!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim!',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            type: 'DELETE',
                            url: '/cadastro/public/admin/clientes/' + id,
                            success: function (response) {
                                if (response.msg) {
                                    Swal.fire(
                                        'Excluído!',
                                        response.msg,
                                        'success'
                                    )
                                        .then((result) => {
                                            location.reload();
                                        });
                                }
                            }
                        });
                    }

                });
            });
        });

    </script>
@endsection
