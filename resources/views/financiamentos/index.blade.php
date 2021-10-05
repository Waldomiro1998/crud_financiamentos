@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Financiamentos Cadastrados</div>
                <div class="card-body">
                <table class="table table-dark">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Valor total</th>
                        <th scope="col">Qtd. Parcelas</th>
                        <th scope="col">Data do financiamento</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Deletar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $financiamentos as $financiamento )
                        <tr>
                        <td>{{ $financiamento->id }}</td>
                        <td>{{ $financiamento->cliente->nome }}</td>
                        <td>{{ $financiamento->valor_total }}</td>
                        <td>{{ $financiamento->total_parcelas }}</td>
                        <td>{{ $financiamento->data_financiamento }}</td>
                        <td>
                            <a href="financiamentos/{{ $financiamento->id }}/edit" class="btn btn-primary">Editar</a>
                        </td>
                        <td>
                            <form action = "financiamentos/delete/{{ $financiamento->id }}" method = "post">
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
                <div class="card-header">Cadastrado de financiamento</div>
                <div class="card-body">
                    <form action ="{{ url('financiamentos/add') }} " method = "post">
                    @csrf
                        <div class="form-group">
                            <label for="inputNome">Cliente</label>
                            <input type="text" name="cliente_id" class="form-control" id="inputNome" placeholder="Digite um nome...">
                            <div class="busca-cliente">

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputNome">Valor total</label>
                            <input type="text" name="valor_total" class="form-control" id="inputNome" placeholder="Digite o valor total...">
                        </div>
                        <div class="form-group">
                            <label for="inputNome">Quantiade de parcelas</label>
                            <input type="number" name="total_parcelas" class="form-control" id="inputNome" placeholder="Quantidade de parcelas..." min="1" max="12">
                        </div>
                        <div class="form-group">
                            <label for="inputNome">Data do financiamento</label>
                            <input type="date" name="data_financiamento" class="form-control" id="inputNome" placeholder="dd/mm/aaaa">
                        </div>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        fetch_data();
        function fetch_data(query = ''){
            $ajax({
                url:"{{ route('financiamento.busca_cliente') }}",
                method: 'GET',
                data:{query:query},
                dataType: 'json'
                success:function(data)
                {
                    $('.busca-cliente').html(data.table_data)
                }
            })
        }
    })
    $(document).on('keyup', '.busca-cliente', function(){
        let query = $(this).val();
        fetch_data(query);
    }) 
</script>
@endsection
