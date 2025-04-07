<?php
namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use App\Models\Project;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::with('project')->paginate(10);
        $projects = Project::all();
        return view('pages.expenses.index', compact('expenses'));
    }

    public function create()
    {
        $projects = Project::all();
        return view('pages.expenses.create')->with('projects', $projects);
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);

        Expense::create($request->all());
        return redirect()->route('expenses.index')->with('success', 'Egreso registrado con éxito.');
    }

    public function edit(Expense $expense)
    {
        $projects = Project::all();
        return view('pages.expenses.edit', compact('expense', 'projects'));
    }

    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'description' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $expense->update($request->all());
        return redirect()->route('expenses.index')->with('success', 'Egreso actualizado con éxito.');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index')->with('success', 'Egreso eliminado con éxito.');
    }
}