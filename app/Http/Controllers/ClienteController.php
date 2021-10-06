<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Financiamento;
use Redirect;
use DB;
class ClienteController extends Controller
{
    public function index(){
        $clientes = Cliente::get();
        return view('clientes.index',['clientes'=> $clientes]);
    }
    public function new(){
        return view('clientes.form');
    }
    public function add( Request $request){
        $request->validate([
            'nome' => 'required'
        ]);
        $cliente = new Cliente;
        $cliente = $cliente->create( $request->all() );
        return Redirect::to('/clientes');
    }
    public function edit($id){
        $cliente = Cliente::findOrFail( $id );
        return view('clientes.form',['cliente'=> $cliente]);
    }

    public function update($id, Request $request){
        $cliente = Cliente::findOrFail( $id );
        $cliente->update( $request->all() );
        return Redirect::to('/clientes');
    }
    public function show($id){
        $cliente = Cliente::findOrFail( $id );
        $financiamento_cliente = DB::table('financiamentos')
        ->where('cliente_id', $cliente->id)
        ->get();
       
        return view('clientes.show',['cliente'=> $cliente,'financiamento_cliente'=>$financiamento_cliente]);
    }

    public function delete($id){
        $cliente = Cliente::findOrFail( $id );
        $cliente->delete( );
        return Redirect::to('/clientes');
    }
    
    public function carrega_financiamento(Request $request){
        $valor_por_mes = array(
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
            6 => 0,
            7 => 0,
            8 => 0,
            9 => 0,
            10 => 0,
            11 => 0,
            12 => 0
        );
        if($request->ajax()){
           
            $query = $request->get('query');
            $cliente = $request->get('cliente');
        
            if($query != ''){
                
                $output = Financiamento::where('data_financiamento','>=',"$query-01-01 00:00:00")
                ->where('data_financiamento','<=',"$query-12-31 00:00:00")->where('cliente_id',$cliente)
                ->get();
                
                if($output->count() >0){
                    foreach ($output as $f){
                 
                        $mes =intval(date('m', strtotime($f->data_financiamento)));
                     
                        $valor_parcela =  $f->valor_total / $f->total_parcelas;
                        if(($f->total_parcelas + $mes)>12){
                            $lenfor = 12;
                        }else{
                            $lenfor = ($f->total_parcelas + $mes) ;
                        }
                       
                        for ($i = $mes; $i < $lenfor ; $i++) {
                            $valor_por_mes[$i] += $valor_parcela;
                        }
    
                    }
                }
                
            }
         
            $data = array(
                'financiamento_do_ano' =>array_values ($valor_por_mes)
            );
            echo json_encode($data);
        }
    }
}
