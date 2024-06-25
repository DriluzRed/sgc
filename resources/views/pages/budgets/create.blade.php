@extends('layouts.app')
@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Cargar nuevo Presupuesto</h1>
                <form action="{{ route('budgets.store') }}" method="POST">
                    @csrf
                    <div class="form-group
                        @error('name')
                            has-error
                        @enderror
                    ">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                        @error('name')
                            <span class="help-block
                                @error('name')
                                    has-error
                                @enderror">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group
                        @error('description')
                            has-error
                        @enderror
                    ">
                        <label for="description">Descripcion</label>
                        <input type="text" name="description" id="description" class="form-control" value="{{ old('description') }}">
                        @error('name')
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
                                <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
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
                        @error('start_date')
                            has-error
                        @enderror">
                        <label for="start_date">Fecha de Emision</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}">
                        @error('budget_date')
                            <span class="help-block
                                @error('start_date')
                                    has-error
                                @enderror">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group
                        @error('end_date')
                            has-error
                        @enderror">
                        <label for="end_date">Fecha de Vencimiento</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}">
                        @error('due_date')
                            <span class="help-block
                                @error('end_date')
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
                        <input type="number" name="amount" id="amount" class="form-control" value="{{ old('amount') }}">
                        @error('amount')
                            <span class="help-block
                                @error('amount')
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