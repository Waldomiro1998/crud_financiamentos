<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Financiamento;
use Redirect;
use DB;
class FinanciamentoController extends Controller
{
    public function index(){
        $financiamentos = Financiamento::get();
        return view('financiamentos.index',['financiamentos'=> $financiamentos]);
    }

    public function new(){
        return view('financiamentos.form');
    }

    public function add( Request $request){
        $request->validate([
            'cliente_id' => 'required',
            'valor_total' => 'required',
            'total_parcelas' => 'required',
            'data_financiamento' => 'required',

        ]);
        $financiamento = new Financiamento;
        $financiamento = $financiamento->create( $request->all() );
        return Redirect::to('/financiamentos');
    }

   

    public function edit($id){
        $financiamento = Financiamento::findOrFail( $id );
        return view('financiamentos.form',['financiamento'=> $financiamento]);
    }

    public function update($id, Request $request){
        $financiamento = Financiamento::findOrFail( $id );
        $financiamento->update( $request->all() );
        return Redirect::to('/financiamentos');
    }

    public function delete($id){
        $financiamento = Financiamento::findOrFail( $id );
        $financiamento->delete( );
        return Redirect::to('/financiamentos');
    }

    public function busca_cliente( Request $request){
        if($request->ajax()){
            
            $query = $request->get('query');
            
            if($query != ''){
                $data = DB::table('clientes')->where('nome','like','%'.$query.'%' )->orwhere('id','like','%'.$query.'%' )->orderBy('id','desc')->get();
               
            }else{
                $data = DB::table('clientes')->orderBy('nome','desc')->get();
            }
            $total = $data->count();

            if($total>0){
                $output="";
                foreach( $data as $d){
                    
                    $output =          
                    "<option value='$d->id'>$d->nome#$d->id</option>";
                   
                }
                error_log($output);
            }else{
                $output = 
                "<option value=''>Não foi encontrado usuários</option>";
            }
            error_log($output);
            $data = array(
                'table_data' => $output
            );
            echo json_encode($data);
        }
    }
}
