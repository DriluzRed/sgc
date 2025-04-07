@extends('layouts.app')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Editar Ingreso</h1>
                <form action="{{ route('incomes.update', $income->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <input type="text" name="description" id="description" class="form-control" 
                               value="{{ $income->description }}" placeholder="Descripción del ingreso" required>
                    </div>
                    <div class="form-group">
                        <label for="amount">Monto</label>
                        <input type="number" name="amount" id="amount" class="form-control" 
                               value="{{ $income->amount }}" placeholder="Monto del ingreso" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Fecha</label>
                        <input type="date" name="date" id="date" class="form-control" 
                               value="{{ $income->date }}" required>
                    </div>
                    <div class="form-group">
                        <label for="client_id">Cliente (opcional)</label>
                        <select name="client_id" id="client_id" class="form-control">
                            <option value="">Seleccionar cliente</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}" 
                                        {{ $income->client_id == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar Ingreso</button>
                    <a href="{{ route('incomes.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection