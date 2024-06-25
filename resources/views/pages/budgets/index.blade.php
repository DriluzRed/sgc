@extends('layouts.app')
@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Lista de Presupuestos</h1>
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <a href="{{ route('budgets.create') }}" class="btn btn-primary">Cargar nuevo Presupuesto</a>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre del proyecto</th>
                            <th>Cliente</th>
                            <th>R.U.C del Cliente</th>
                            <th>Fecha de Emision</th>
                            <th>Fecha de vencimiento</th>
                            <th>Monto</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($budgets as $budget)
                            <tr>
                                <td>{{ $budget->name }}</td>
                                <td>{{ $budget->client->name }}</td>
                                <td>{{ $budget->client->ruc }}</td>
                                <td>{{ $budget->start_date }}</td>
                                <td>{{ $budget->end_date }}</td>
                                <td>{{ $budget->amount }}</td>
                                <td>
                                    @switch($budget->status)
                                        @case('pending')
                                            <span class="badge badge-warning">Pendiente</span>
                                            @break

                                        @case('approved')
                                            <span class="badge badge-success">Aprobado</span>
                                            @break

                                        @case('rejected')
                                            <span class="badge badge-danger">Rechazado</span>
                                            @break

                                        @default
                                            <span class="badge badge-secondary">Desconocido</span>
                                    @endswitch
                                </td>
                                <td>
                                    <a href="{{ route('budgets.edit', $budget->id) }}" class="btn btn-warning">Editar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
