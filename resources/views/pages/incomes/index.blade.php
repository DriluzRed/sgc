@extends('layouts.app')
@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Lista de Ingresos</h1>
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <a href="{{ route('incomes.create') }}" class="btn btn-primary">Cargar nuevo Ingreso</a>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Descripción</th>
                            <th>Monto</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($incomes as $income)
                            <tr>
                                <td>{{ $income->description }}</td>
                                <td>{{ $income->amount }}</td>
                                <td>{{ $income->date }}</td>
                                <td>{{ $income->client ? $income->client->name : 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('incomes.edit', $income->id) }}" class="btn btn-warning">Editar</a>
                                    <form action="{{ route('incomes.destroy', $income->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de que desea eliminar este ingreso?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $incomes->links() }}
            </div>
        </div>
    </div>
@endsection