@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success"></div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    Bem vindo, {{ Auth::user()->name }} !
                </div>

            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if($clientes->count() > 0)
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Clientes</th>
                                <th scope="col">Vizualizar financiamentos</th>
                                <th scope="col">Editar</th>
                                <th scope="col">Excluir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $clientes as $cliente )
                            <tr>
                                <td>{{ $cliente->id }}</td>
                                <td>{{ $cliente->nome }}</td>
                                <td>
                                    <a href="clientes/{{ $cliente->id }}/show" class="btn btn-warning">Vizualizar</a>
                                </td>

                                <td>
                                    <a href="clientes/{{ $cliente->id }}/edit" class="btn btn-primary">Editar</a>
                                </td>
                                <td>
                                    <form action="clientes/delete/{{ $cliente->id }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger">Deletar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="card-header">
                        <p class="text-danger">Nenhum cliente cadastrado</p>
                    </div>
                    @endif
                </div>
                <h5> Total de financiamentos:{{$financiamentos->count()}}</h5>
                <h5> Total de clientes:{{$clientes->count()}}</h5>
            </div>
        </div>
    </div>
</div>
@endsection