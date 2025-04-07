 @extends('layouts.app')

 @section('main-content')
     <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1>Cargar nuevo Ingreso</h1>
                 <form action="{{ route('incomes.store') }}" method="POST">
                     @csrf
                     <div class="form-group">
                         <label for="description">Descripción</label>
                         <input type="text" name="description" id="description" class="form-control"
                             placeholder="Descripción del ingreso" required>
                     </div>
                     <div class="form-group">
                         <label for="amount">Monto</label>
                         <input type="number" name="amount" id="amount" class="form-control"
                             placeholder="Monto del ingreso" step="0.01" required>
                     </div>
                     <div class="form-group">
                         <label for="date">Fecha</label>
                         <input type="date" name="date" id="date" class="form-control" required>
                     </div>
                     <div class="form-group">
                         <label for="client_id">Cliente (opcional)</label>
                         <select name="client_id" id="client_id" class="form-control">
                             <option value="">Seleccionar cliente</option>
                             @foreach ($clients as $client)
                                 <option value="{{ $client->id }}">{{ $client->name }}</option>
                             @endforeach
                         </select>
                     </div>
                     <button type="submit" class="btn btn-primary">Guardar Ingreso</button>
                     <a href="{{ route('incomes.index') }}" class="btn btn-secondary">Cancelar</a>
                 </form>
             </div>
         </div>
     </div>
 @endsection
