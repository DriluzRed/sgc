@extends('layouts.app')
@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Lista de Facturas</h1>
                <a href="{{ route('invoices.create') }}" class="btn btn-primary">Cargar nueva Factura</a>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Proyecto</th>
                            <th>N° de Factrua</th>
                            <th>Cliente</th>
                            <th>R.U.C del Cliente</th>
                            <th>Fecha de Emision</th>
                            <th>Fecha de vencimiento</th>
                            <th>Monto</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->project->name }}</td>
                                <td>{{ $invoice->invoice_number }}</td>
                                <td>{{ $invoice->client->name }}</td>
                                <td>{{ $invoice->client->ruc }}</td>
                                <td>{{ $invoice->invoice_date }}</td>
                                <td>{{ $invoice->due_date }}</td>
                                <td>{{ $invoice->amount }}</td>
                                <td>
                                    <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-info">Ver datos</a>
                                    <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-warning">Editar</a>
                                    <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
