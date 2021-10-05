@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Clientes</div>
                <div class="card-body">
                <table class="table table-dark">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $clientes as $cliente )
                        <tr>
                        <td>{{ $cliente->id }}</td>
                        <td>{{ $cliente->nome }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cadastrado de cliente</div>
                <div class="card-body">
                    <form action ="{{ url('clientes/add') }} " method = "post">
                    @csrf
                        <div class="form-group">
                            <label for="inputNome">Nome do cliente</label>
                            <input type="text" name="nome" class="form-control" id="inputNome" placeholder="Digite um nome...">
                        </div>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
