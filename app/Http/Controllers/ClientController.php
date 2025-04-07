<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function index(){
        $clients = Client::paginate(10);
        return view('pages.clients.index')->with('clients', $clients);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'ruc' => 'required',
        ]);

        Client::create($request->all());
        return redirect()->route('clients.index');
    }

    public function edit(Client $client){
        return view('pages.clients.edit')->with('client', $client);
    }

    public function update(Request $request, Client $client){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'ruc' => 'required',
        ]);

        $client->update($request->all());
        return redirect()->route('clients.index');
    }


    public function destroy(Client $client){
        if($client->projects()->count() > 0) {
            return redirect()->route('clients.index')->with('error', 'No se puede eliminar el cliente porque tiene proyectos asociados.');
        }
        if($client->invoices()->count() > 0) {
            return redirect()->route('clients.index')->with('error', 'No se puede eliminar el cliente porque tiene facturas asociadas.');
        }
        if($client->budgets()->count() > 0) {
            return redirect()->route('clients.index')->with('error', 'No se puede eliminar el cliente porque tiene presupuestos asociados.');
        }

        $client->delete();
        return redirect()->route('clients.index');
    }

    public function show(Client $client){
        return view('pages.clients.show')->with('client', $client);
    }

    public function create(){
        return view('pages.clients.create');
    }

    
}
