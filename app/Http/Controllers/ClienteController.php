<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Redirect;
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

    public function delete($id){
        $cliente = Cliente::findOrFail( $id );
        $cliente->delete( );
        return Redirect::to('/clientes');
    }

}
