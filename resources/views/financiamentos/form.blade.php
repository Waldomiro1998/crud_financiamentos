@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cadastrado de financiamento</div>
                <div class="card-body">
                    <form action="{{ url('financiamentos/update') }}/{{$financiamento->id}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="cliente_id">Cliente</label>
                            <select name="cliente_id" id="cliente_id">
                            </select>
                            <input type="text" name="field_busca" class="form-control" id="field_busca" placeholder="Busque por um cliente...">
                        </div>
                        <div class="form-group">
                            <label for="inputNome">Valor total</label>
                            <input type="text" name="valor_total" class="form-control" value="{{$financiamento->valor_total}}">
                        </div>
                        <div class="form-group">
                            <label for="inputNome">Quantiade de parcelas</label>
                            <input type="number" name="total_parcelas" class="form-control" value="{{$financiamento->total_parcelas}}" min="1" max="12">
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
<script>
    function fetch_data(query = '') {
        $.ajax({
            url: "{{ route('financiamento.busca_cliente') }}",
            method: 'GET',
            data: {
                query: query
            },
            dataType: 'json',
            success: function(data) {
                $('#cliente_id').html(data.table_data)
            }
        })
    }

    $("#field_busca").keyup(function() {
        let query = $(this).val();
        fetch_data(query);
    })
</script>
@endsection