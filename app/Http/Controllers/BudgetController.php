<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;
use App\Models\Client;
use App\Models\Project;

class BudgetController extends Controller
{
    public function index()
    {
        $budgets = Budget::all();
        return view('pages.budgets.index')->with('budgets', $budgets);
    }

    public function create()
    {
        $clients = Client::all();
        return view('pages.budgets.create')->with('clients', $clients);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string',
            'amount' => 'required|int',
            'start_date' => 'required',
            'end_date' => 'required',
            'client_id' => 'required|exists:clients,id',
            'description' => 'required|string',
        ]);
        // if($request->validate() == false){
        //     return redirect()->back()->withInput();
        // }
        // dd($request->all());

        Budget::create([
            'name' => $request->name,
            'amount' => $request->amount,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'client_id' => $request->client_id,
            'user_id' => $user->id,
            'project_id' => null,
            'description' => $request->description,
            'status' => 'pending',

        ]);
        return redirect()->route('budgets.index');
    }

    public function show($id)
    {
        $budget = Budget::find($id);
        return view('pages.budgets.show')->with('budget', $budget);
    }

    public function edit($id)
    {
        $budget = Budget::find($id);
        if($budget->status == 'approved'){
            return redirect()->route('budgets.index')->with('error', 'No puedes editar un presupuesto aprobado');
        }
        if($budget->status == 'rejected'){
            return redirect()->route('budgets.index')->with('error', 'No puedes editar un presupuesto rechazado');
        }

        $clients = Client::all();
        $statuses = [
            Budget::STATUS_PENDING => 'Pendiente',
            Budget::STATUS_APPROVED => 'Aprobado',
            Budget::STATUS_REJECTED => 'Rechazado',
        ];
        return view('pages.budgets.edit')->with('budget', $budget)->with('clients', $clients)->with('statuses', $statuses);
    }

    public function update(Request $request, $id){
        $user = auth()->user();
        $request->validate([
            'name' => 'required',
            'amount' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'client_id' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        $budget = Budget::find($id);
        $budget->name = $request->name;
        $budget->amount = $request->amount;
        $budget->start_date = $request->start_date;
        $budget->end_date = $request->end_date;
        $budget->client_id = $request->client_id;
        $budget->user_id = $user->id;
        $budget->description = $request->description;
        $budget->status = $request->status;
        if($request->status == 'approved'){
            $project = New Project();
            $project->name = $budget->name;
            $project->client_id = $budget->client_id;
            $project->user_id = $budget->user_id;
            $project->description = $budget->description;
            $budget->project_id = $project->id;
            $project->save();
            return redirect()->route('projects.index')->with('success', 'Presupuesto actualizado y proyecto creado');
        }
        return redirect()->route('budgets.index');
    }


}
