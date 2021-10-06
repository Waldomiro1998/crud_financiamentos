@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Atualizar dados de cliente</div>
                <div class="card-body">
                    <form action="{{ url('clientes/update') }}/{{$cliente->id}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="inputNome">Cliente</label>
                            <input type="text" name="nome" class="form-control" value="{{$cliente->nome}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection