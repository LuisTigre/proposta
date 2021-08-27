<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Proposta;

class ClientesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $clientes = Cliente::lista(1000);

        return view('clientes.index',compact('clientes'));
    }
    
    public function show($id)
    {
        
        $cliente = Cliente::find($id);

        return $cliente;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $cliente = Cliente::create($data);
        $cliente->save();
        return redirect(route('clientes.index'))->with('status', 'Cliente adicionado com sucesso');
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        Cliente::find($id)->update($data);
        return redirect(route('clientes.index'))->with('status', 'Cliente actualizado com sucesso');
    }

    public function destroy($id)
    {
        Cliente::find($id)->delete();
        return redirect()->back();
    }

   

    
}
