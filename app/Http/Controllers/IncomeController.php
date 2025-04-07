<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\Client;

class IncomeController extends Controller
{
    public function index()
    {
        $incomes = Income::white('client')->paginate(10);
        return view('pages.incomes.index', compact('incomes'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('pages.incomes.create')->with('clients', $clients);
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);

        Income::create($request->all());
        return redirect()->route('incomes.index')->with('success', 'Ingreso registrado con éxito.');
    }

    public function edit(Income $income)
    {
        $clients = Client::all();
        return view('pages.incomes.edit', compact('income', 'clients'));
    }

    public function update(Request $request, Income $income)
    {
        $request->validate([
            'description' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $income->update($request->all());
        return redirect()->route('incomes.index')->with('success', 'Ingreso actualizado con éxito.');
    }

    public function destroy(Income $income)
    {
        $income->delete();
        return redirect()->route('incomes.index')->with('success', 'Ingreso eliminado con éxito.');
    }
}
