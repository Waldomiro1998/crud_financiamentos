@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1>{{$cliente->nome}}</h1>

    </div>
    @if($financiamento_cliente->count() > 0)
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Financiamentos de {{$cliente->nome}} </div>
                <div class="card-body">

                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Valor total</th>
                                <th scope="col">Qtd. Parcelas</th>
                                <th scope="col">Data do financiamento</th>
                                <th scope="col">Editar</th>
                                <th scope="col">Deletar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $financiamento_cliente as $financiamento )
                            <tr>
                                <td>{{ $financiamento->id }}</td>
                                <td>{{ $financiamento->valor_total }}</td>
                                <td>{{ $financiamento->total_parcelas }}</td>
                                <td>{{ $financiamento->data_financiamento }}</td>

                                <td>
                                    <a href="/financiamentos/{{ $financiamento->id }}/edit" class="btn btn-primary">Editar</a>
                                </td>
                                <td>
                                    <form action="/financiamentos/delete/{{ $financiamento->id }}" method="post">
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
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Valor dos financiamentos baseado em um ano</div>
                <div class="card-body">
                    <div class="chart-area">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <canvas id="myAreaChart" width="1037" height="320" style="display: block; width: 1037px; height: 320px;" class="chartjs-render-monitor"></canvas>
                    </div>
                    <div class="row justify-content-center">
                        <div class="card-header">Ano:
                            <input type="number" id="ano_financiamento" min="1900" max="2099" step="1" placeholder="2021" />
                            <input type="hidden" id="cliente_id" value="{{$cliente->id}}" />
                        </div>

                    </div>
                    <a href="  {{ url()->previous() }}" class="btn btn-primary ">Voltar</a>
                </div>
                @else
                <div class="card-header">
                    <p class="text-danger">Nenhum financiamento cadastrado para este cliente</p>
                    <a href="  {{ url()->previous() }}" class="btn btn-primary ">Voltar</a>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ url('/js/chart-area-demo.js') }}"></script>

    <script>
        var ctx = document.getElementById("myAreaChart");

        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Custo do financiamento mensal",
                    lineTension: 0.3,
                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: [],
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return '$' + number_format(value);
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                        }
                    }
                }
            }
        });


        function carrega_financiamentos(query = 2021) {
            let cliente = $("#cliente_id").val();
            $.ajax({
                url: "{{ route('clientes.carrega_financiamento') }}",
                method: 'GET',
                data: {
                    query: query,
                    cliente: cliente
                },
                dataType: 'json',
                success: function(data) {
                    removeData(myLineChart);
                    addData(myLineChart, data.financiamento_do_ano);
                }
            })
        }

        carrega_financiamentos(2021);

        $("#ano_financiamento").change(function() {
            let query = Number($(this).val());
            carrega_financiamentos(query);
        })

        number_format(1234.56, 2, ',', ' ');
    </script>

    @endsection