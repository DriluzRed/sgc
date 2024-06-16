@extends('layouts.app')
@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Cargar nueva Factura</h1>
                <form action="{{ route('invoices.store') }}" method="POST">
                    @csrf
                    <div class="form-group
                        @error('title')
                            has-error
                        @enderror">
                        <label for="title">Titulo</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
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
                        <input type="text" name="description" id="description" class="form-control" value="{{ old('description') }}">
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
                        @error('project_id')
                            has-error
                        @enderror">
                        <label for="project_id">Proyecto</label>
                        <select name="project_id" id="project_id" class="form-control select2">
                            <option value="">Seleccione un proyecto</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
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
                        <label for="invoice_number">N° de Factura</label>
                        <input type="text" name="invoice_number" id="invoice_number" class="form-control" value="{{ old('invoice_number') }}">
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
                        @error('client_id')
                            has-error
                        @enderror">
                        <label for="client_id">Cliente</label>
                        <select name="client_id" id="client_id" class="form-control select2">
                            <option value="">Seleccione un cliente</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
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
                        @error('invoice_date')
                            has-error
                        @enderror">
                        <label for="invoice_date">Fecha de Emision</label>
                        <input type="date" name="invoice_date" id="invoice_date" class="form-control" value="{{ old('invoice_date') }}">
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
                        <label for="due_date">Fecha de vencimiento</label>
                        <input type="date" name="due_date" id="due_date" class="form-control" value="{{ old('due_date') }}">
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
                        <input type="text" name="amount" id="amount" class="form-control" value="{{ old('amount') }}">
                        @error('amount')
                            <span class="help-block
                                @error('amount')
                                    has-error
                                @enderror">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <label for="status_id">Estado</label>
                        <select name="status_id" id="status_id" class="form-control select2">
                            <option value="">Seleccione un estado</option>
                            @foreach($statuses as $key => $status)
                                <option value="{{ $key }}">{{ $status }}</option>
                            @endforeach
                        </select>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
@endsection

