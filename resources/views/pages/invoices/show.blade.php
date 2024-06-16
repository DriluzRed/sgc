@extends('layouts.app')
@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Factura</h1>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title
                            @if($invoice->status == 'paid')
                                text-success
                            @elseif($invoice->status == 'pending')
                                text-warning
                            @else
                                text-danger
                            @endif">
                            {{ $invoice->title }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <p>{{ $invoice->description }}</p>
                        <p>
                            <strong>Proyecto:</strong> {{ $invoice->project->name }}
                        </p>
                        <p>
                            <strong>Numero de Factura:</strong> {{ $invoice->invoice_number }}
                        </p>
                        <p>
                            <strong>Fecha de Emision:</strong> {{ $invoice->issue_date }}
                        </p>
                        <p>
                            <strong>Fecha de Vencimiento:</strong> {{ $invoice->due_date }}
                        </p>
                        <p>
                            <strong>Monto:</strong> {{ $invoice->amount }}
                        </p>
                        <p>
                            <strong>Estado:</strong>
                            @if($invoice->status == 'paid')
                                <span class="badge badge-success">Pagada</span>
                            @elseif($invoice->status == 'pending')
                                <span class="badge badge-warning">Pendiente</span>
                            @else
                                <span class="badge badge-danger">Vencida</span>
                            @endif
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-primary">Editar</a>
                        <a href="{{ route('invoices.index') }}" class="btn btn-secondary">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
