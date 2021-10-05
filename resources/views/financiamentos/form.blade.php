@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Cadastrado de financiamento</div>
            <div class="card-body">
                <form action ="{{ url('financiamentos/update') }}/{{$financiamento->id}}" method = "post">
                @csrf
                    <div class="form-group">
                        <label for="inputNome">Cliente</label>
                        <input type="text" name="cliente_id" class="form-control"  value="{{$financiamento->id}}">
                        <div class="busca-cliente">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputNome">Valor total</label>
                        <input type="text" name="valor_total" class="form-control"  value="{{$financiamento->valor_total}}">
                    </div>
                    <div class="form-group">
                        <label for="inputNome">Quantiade de parcelas</label>
                        <input type="number" name="total_parcelas" class="form-control"  value="{{$financiamento->total_parcelas}}" min="1" max="12">
                    </div>
                    <div class="form-group">
                        <label for="inputNome">Data do financiamento</label>
                        <input type="date" name="data_financiamento" class="form-control" value="{{Carbon\Carbon::parse($financiamento->data_financiamento)->format('Y-m-d')}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </form>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
