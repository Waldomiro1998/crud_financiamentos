@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Lista de Clientes</div>
                <div class="card-body">
                <table class="table table-dark">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Deletar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $clientes as $cliente )
                        <tr>
                        <td>{{ $cliente->id }}</td>
                        <td>{{ $cliente->nome }}</td>
                        <td>
                            <a href="clientes/{{ $cliente->id }}/edit" class="btn btn-primary">Editar</a>
                        </td>
                        <td>
                            <form action = "clientes/delete/{{ $cliente->id }}" method = "post">
                            @csrf
                            @method('delete')
                                <button class="btn btn-danger">Deletar</button>
                            </form>    
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cadastrado de Cliente</div>
                <div class="card-body">
                    <form action ="{{ url('clientes/add') }} " method = "post">
                    @csrf
                        <div class="form-group">
                            <label for="inputNome">Cliente</label>
                            <input type="text" name="nome" class="form-control" placeholder="Digite um nome...">
                        </div>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
