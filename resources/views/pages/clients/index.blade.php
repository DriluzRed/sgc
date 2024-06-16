@extends('layouts.app')
@section('main-content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h2>{{__('clients.Clients')}}</h2>
            <a href="{{ route('clients.create') }}" class="btn btn-primary">{{__('clients.Add Client')}}</a>
            <table class="table mt-3 dataTable table-bordered">
                <thead>
                    <tr class="text-right">
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Telefono</th>
                        <th>N° de R.U.C</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                    <tr>
                        <td class="text-right">{{ $client->name }}</td>
                        <td class="text-right">{{ $client->email }}</td>
                        <td class="text-right">{{ $client->phone }}</td>
                        <td class="text-right">{{ $client->ruc }}</td>
                        <td class="text-right">
                            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary">Editar</a>
                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Borrar</button>
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