@extends('layouts.app')

@section('main-content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1>Editar Factura</h1>
            <form action="{{ route('invoices.update', $invoice->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group
                    @error('title')
                        has-error
                    @enderror">
                    <label for="title">Titulo</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $invoice->title) }}">
                    @error('title')
                        <span class="help-block
                            @error('title')
                                has-error
                            @enderror">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group
                    @error('description')
                        has-error
                    @enderror">
                    <label for="title">Descripcion</label>
                    <input type="text" name="description" id="description" class="form-control" value="{{ old('description', $invoice->description) }}">
                    @error('description')
                        <span class="help-block
                            @error('description')
                                has-error
                            @enderror">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group 
                    @error('client_id')
                        has-error
                    @enderror">
                    <label for="client_id">Cliente</label>
                    <select name="client_id" id="client_id" class="form-control select2">
                        <option value="">Seleccione un cliente</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ $client->id == $invoice->client_id ? 'selected' : '' }}>{{ $client->name }}</option>
                        @endforeach
                    </select>
                    @error('client_id')
                        <span class="help-block
                            @error('client_id')
                                has-error
                            @enderror">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group
                    @error('project_id')
                        has-error
                    @enderror">
                    <label for="project_id">Proyecto</label>
                    <select name="project_id" id="project_id" class="form-control select2">
                        <option value="">Seleccione un proyecto</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ $project->id == $invoice->project_id ? 'selected' : '' }}>{{ $project->name }}</option>
                        @endforeach
                    </select>
                    @error('project_id')
                        <span class="help-block
                            @error('project_id')
                                has-error
                            @enderror">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group
                    @error('invoice_number')
                        has-error
                    @enderror">
                    <label for="invoice_number">Numero de Factura</label>
                    <input type="text" name="invoice_number" id="invoice_number" class="form-control" value="{{ old('invoice_number', $invoice->invoice_number) }}">
                    @error('invoice_number')
                        <span class="help-block
                            @error('invoice_number')
                                has-error
                            @enderror">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group
                    @error('invoice_date')
                        has-error
                    @enderror">
                    <label for="invoice_date">Fecha de Emision</label>
                    <input type="date" name="invoice_date" id="invoice_date" class="form-control" value="{{ old('invoice_date', $invoice->invoice_date) }}">
                    @error('invoice_date')
                        <span class="help-block
                            @error('invoice_date')
                                has-error
                            @enderror">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group
                    @error('due_date')
                        has-error
                    @enderror">
                    <label for="due_date">Fecha de Vencimiento</label>
                    <input type="date" name="due_date" id="due_date" class="form-control" value="{{ old('due_date', $invoice->due_date) }}">
                    @error('due_date')
                        <span class="help-block
                            @error('due_date')
                                has-error
                            @enderror">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group
                    @error('amount')
                        has-error
                    @enderror">
                    <label for="amount">Monto</label>
                    <input type="text" name="amount" id="amount" class="form-control" value="{{ old('amount', $invoice->amount) }}">
                    @error('amount')
                        <span class="help-block

                            @error('amount')
                                has-error
                            @enderror">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group
                    @error('status')
                        has-error
                    @enderror">
                    <label for="status">Estado</label>
                    <select name="status" id="status" class="form-control select2">
                        <option value="paid" {{ $invoice->status == 'paid' ? 'selected' : '' }}>Pagada</option>
                        <option value="pending" {{ $invoice->status == 'pending' ? 'selected' : '' }}>Pendiente</option>
                        <option value="canceled" {{ $invoice->status == 'canceled' ? 'selected' : '' }}>Cancelado</option>
                    </select>
                    @error('status')
                        <span class="help-block
                            @error('status')
                                has-error
                            @enderror">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
</div>
@endsection