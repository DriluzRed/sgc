<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Client;
use App\Models\Project;
class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();
        return view('pages.invoices.index')->with('invoices', $invoices);
    }

    public function create()
    {
        $clients = Client::all();
        $projects = Project::all();
        $statuses = [
            Invoice::STATUS_PENDING => 'Pendiente',
            Invoice::STATUS_PAID => 'Pagado',
            Invoice::STATUS_CANCELED => 'Cancelado',
        ];
        return view('pages.invoices.create')->with('clients', $clients)->with('projects', $projects)->with('statuses', $statuses);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client_id' => 'required',
            'project_id' => 'required',
            'invoice_date' => 'required',
            'due_date' => 'required',
            'amount' => 'required',
            'invoice_number' => 'required',
        ]);

        $invoice = new Invoice();
        $invoice->title = $request->title;
        $invoice->description = $request->description;
        $invoice->client_id = $request->client_id;
        $invoice->invoice_number = $request->invoice_number;
        $invoice->project_id = $request->project_id;
        $invoice->invoice_date = $request->invoice_date;
        $invoice->due_date = $request->due_date;
        $invoice->amount = $request->amount;
        $invoice->save();
        return redirect()->route('invoices.index');
    }

    public function show($id)
    {
        $invoice = Invoice::find($id);
        return view('pages.invoices.show')->with('invoice', $invoice);
    }

    public function edit($id)
    {
        $invoice = Invoice::find($id);
        $clients = Client::all();
        $projects = Project::all();
        $statuses = [
            Invoice::STATUS_PENDING => 'Pendiente',
            Invoice::STATUS_PAID => 'Pagado',
            Invoice::STATUS_CANCELED => 'Cancelado',
        ];
        return view('pages.invoices.edit')->with('invoice', $invoice)->with('clients', $clients)->with('projects', $projects)->with('statuses', $statuses);
    }

    public function update(Request $request, $id)
    {

        $invoice = Invoice::find($id);
        $invoice->title = $request->title;
        $invoice->description = $request->description;
        $invoice->client_id = $request->client_id;
        $invoice->invoice_number = $request->invoice_number;
        $invoice->project_id = $request->project_id;
        $invoice->invoice_date = $request->invoice_date;
        $invoice->due_date = $request->due_date;
        $invoice->amount = $request->amount;
        $invoice->status = $request->status;
        $invoice->save();
        return redirect()->route('invoices.index');
    }

    public function destroy($id)
    {
        $invoice = Invoice::find($id);
        $invoice->delete();
        return redirect()->route('invoices.index');
    }

    public function getTotalInvoices($project_id)
    {
        $totalInvoices = Invoice::where('project_id', $project_id)->count();
        return $totalInvoices;
    }
}
