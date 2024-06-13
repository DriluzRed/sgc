@extends('layouts.app')

@section('main-content')
<div class="container mt-5">
    <div class="row">
        @foreach($statuses as $status => $label)
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header {{ $colors[$status] }} text-white">
                    <h3>{{ $label }}</h3>
                </div>
                <ul class="list-group list-group-flush bg-light" data-status="{{ $status }}" style="min-height: 200px;">
                    @foreach($projects->get($status, []) as $project)
                    <li class="list-group-item d-flex justify-content-between align-items-center" data-project-id="{{ $project->id }}" style="border: 2px solid #007bff; border-radius: 10px;">
                        {{ $project->name }}
                        <div>
                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="modal fade" id="projectModal" tabindex="-1" role="dialog" aria-labelledby="projectModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="projectModalLabel">Tareas del proyecto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Aquí se cargarán las tareas del proyecto -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.list-group').each(function() {
            new Sortable(this, {
                group: 'shared',
                animation: 150,
                onEnd: function(evt) {
                    var project = evt.item;
                    var projectId = $(project).data('project-id');
                    var status = $(project).parent().data('status');

                    $.ajax({
                        url: '/projects/' + projectId + '/updateStatus',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        contentType: 'application/json',
                        data: JSON.stringify({
                            status: status
                        }),
                        success: function(response) {
                            // handle success
                        },
                        error: function() {
                            console.log('Error', response.xhr.responseText)
                        }
                    });
                }
            });
        });
        $('.list-group-item').on('click', function() {
            var projectId = $(this).data('project-id');
            loadProjectTasks(projectId);
        });
    });
    
    function loadProjectTasks(projectId) {
    $.ajax({
        url: '/projects/' + projectId + '/tasks',
        method: 'GET',
        success: function(response) {
            console.log('Response', response);
            var modal = $('#projectModal');
            var modalBody = modal.find('.modal-body');
            modalBody.empty();

            // Crear contenedores para cada estado
            var pendingTasks = $('<div>').append('<h5>Pendiente</h5>');
            var inProgressTasks = $('<div>').append('<h5>En Progreso</h5>');
            var completedTasks = $('<div>').append('<h5>Completado</h5>');

            // Procesar tareas pendientes
            if (response.pending) {
                response.pending.forEach(function(task) {
                    pendingTasks.append(createTaskHtml(task));
                });
            }

            // Procesar tareas en progreso
            if (response.in_progress) {
                response.in_progress.forEach(function(task) {
                    inProgressTasks.append(createTaskHtml(task));
                });
            }

            // Procesar tareas completadas
            if (response.completed) {
                response.completed.forEach(function(task) {
                    completedTasks.append(createTaskHtml(task));
                });
            }

            // Añadir los contenedores al cuerpo del modal
            modalBody.append(pendingTasks);
            modalBody.append(inProgressTasks);
            modalBody.append(completedTasks);
            $('.select2').select2();
            modal.modal('show');
        },
        error: function(response) {
            console.log('Error', response.responseText);
        }
    });
}

function createTaskHtml(task) {
    return `
        <div class="alert alert-info d-flex justify-content-between">
            ${task.name}
            <select class="task-status select2" data-task-id="${task.id}">
                <option value="pendiente"${task.status === 'pending' ? ' selected' : ''}>Pendiente</option>
                <option value="en_progreso"${task.status === 'in_progress' ? ' selected' : ''}>En progreso</option>
                <option value="completado"${task.status === 'completed' ? ' selected' : ''}>Completado</option>
            </select>
        </div>
    `;
}
</script>
@endsection
