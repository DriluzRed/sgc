@extends('layouts.app')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Editar Egreso</h1>
                <form action="{{ route('expenses.update', $expense->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <input type="text" name="description" id="description" class="form-control" 
                               value="{{ $expense->description }}" placeholder="Descripción del egreso" required>
                    </div>
                    <div class="form-group">
                        <label for="amount">Monto</label>
                        <input type="number" name="amount" id="amount" class="form-control" 
                               value="{{ $expense->amount }}" placeholder="Monto del egreso" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Fecha</label>
                        <input type="date" name="date" id="date" class="form-control" 
                               value="{{ $expense->date }}" required>
                    </div>
                    <div class="form-group">
                        <label for="project_id">Proyecto (opcional)</label>
                        <select name="project_id" id="project_id" class="form-control">
                            <option value="">Seleccionar proyecto</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}" 
                                        {{ $expense->project_id == $project->id ? 'selected' : '' }}>
                                    {{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar Egreso</button>
                    <a href="{{ route('expenses.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection