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
}
