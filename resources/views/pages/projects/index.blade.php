@extends('layouts.app')

@section('main-content')
<div class="container mt-5">
    <div class="row">
        @foreach($statuses as $status => $label)
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header {{ $colors[$status] }} text-white">
                    <h3>{{ $label }}  <button class="btn btn-light btn-sm new-project" data-status="{{ $status }}">
                        <i class="fas fa-plus"></i>
                    </button></h3>
                   
                </div>
                <ul class="list-group list-group-flush bg-light" data-status="{{ $status }}" style="min-height: 200px;">
                    @foreach($projects->get($status, []) as $project)
                    <li class="list-group-item d-flex justify-content-between align-items-center" data-project-id="{{ $project->id }}" style="border: 2px solid #007bff; border-radius: 10px;">
                        {{ $project->name }}
                        <div>
                            
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
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="projectModalLabel">Tareas del proyecto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
</div>

<div class="modal" id="commentModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar comentario</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="commentForm">
                    <div class="form-group">
                        <label for="comment">Comentario</label>
                        <input type="text" class="form-control" id = "project-comment" name="comment" required>
                    </div>
                    <button type="button" id="save-comment" class="btn btn-primary">Agregar comentario</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="taskModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar nueva tarea</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="commentForm">
                    <div class="form-group">
                        <label for="comment">Nombre de la tarea</label>
                        <input type="text" class="form-control" id = "project-task" name="roject-task" required>
                    </div>
                    <div class="form-group">
                        <label for="comment">Descripcion de la tarea</label>
                        <input type="text" class="form-control" id = "project-task-desc" name="project-task-desc" required>
                    </div>
                    <div class="form-group
                    ">
                        <label for="comment">Seleccione el estado de la tarea</label>
                        <select class="form-control" id="task-status" name="task-status" required>
                            <option value="pending">Pendiente</option>
                            <option value="in_progress">En progreso</option>
                            <option value="completed">Completado</option>
                        </select>
                    </div>
                    <button type="button" id="save-task" class="btn btn-primary">Guardar la nueva tarea</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="editcommentModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar comentario</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="commentForm">
                    <div class="form-group">
                        <label for="comment">Comentario</label>
                        <input type="text" class="form-control" id = "edit-project-comment" name="comment" required>
                    </div>
                    <button type="button" id="save-comment" class="btn btn-primary">Actualizar comentario</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="addProjectModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar un nuevo proyecto</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="projectForm">
                    <div class="form-group">
                        <div class="row">
                            <div class="col"> 
                                <label for="cliente">Nombre del proyecto:</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id = "project-name" name="project-name" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col"> 
                                <label for="cliente">Descripcion del proyecto:</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id = "project-description" name="project-description" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="cliente">Seleccione el cliente:</label>
                            </div>
                           <div class="col">
                                <select class="form-control select2" id="client" name="client" required>
                                    <option value="">Selecciona un cliente</option>
                                    @foreach($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="save-project" class="btn btn-primary">Guardar proyecto</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        var currentProjectId;
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
            currentProjectId = projectId;
            loadProjectTasks(projectId);
        });
        $(document).on('change', '.task-status', function() {
            var taskId = $(this).data('task-id');
            var status = $(this).val();

            $.ajax({
                url: '/tasks/' + taskId + '/updateStatus',
                method: 'POST',
                data: {
                    status: status,
                    _method: 'POST',
                },
                success: function(response) {
                    loadProjectTasks(response.project_id);
                },
                error: function(response) {
                    console.log('Error', response.responseText);
                }
            });
        });
        $(document).on('click', '#save-comment', function(e) {
            var projectId = currentProjectId;
            $('#commentModal').modal('show');
            var comment = $('#project-comment').val();
            console.log('Comment', comment);
            $.ajax({
                url: '/projects/' + projectId + '/comments',
                method: 'POST',
                data: {
                    comment: comment,
                },
                success: function(response) {
                    loadComments(projectId);
                    comment = '';
                    $('#commentModal').modal('hide');
                },
                error: function(response) {
                    console.log('Error', response.responseText);
                }
            });
        });
        $(document).on('click', '#save-task', function(e) {
            var projectId = currentProjectId;
            var task = $('#project-task').val();
            var taskDesc = $('#project-task-desc').val();
            var status = $('#task-status').val();
            $.ajax({
                url: '/projects/' + projectId + '/tasksStore',
                method: 'POST',
                data: {
                    name: task,
                    description: taskDesc,
                    status: status,
                },
                success: function(response) {
                    loadProjectTasks(projectId);
                    $('#taskModal').modal('hide');
                },
                error: function(response) {
                    console.log('Error', response.responseText);
                }
            });
        });
        $(document).on('click', '.edit-comment', function() {
            $(document).on('click', '.edit-comment', function() {
                var commentId = $(this).data('id');
            
                $.ajax({
                    url: '/comments/' + commentId,
                    method: 'GET',
                    success: function(response) {
                        $('#edit-project-comment').val(response.comment);
                        $('#editcommentModal').modal('show');
                    },
                    error: function(response) {
                        console.log('Error', response.responseText);
                    }
                });
            });
        });
        
        $(document).on('click', '.delete-comment', function() {
            var commentId = $(this).data('id');
        });

        $(document).on('click', '.new-project', function() {
            var status = $(this).data('status');    
            $('#addProjectModal').modal('show');
            $('select2').select2();
        });

        $(document).on('click', '#save-project', function() {
            var projectName = $('#project-name').val();
            var status = $('.new-project').data('status');
            var client = $('#client').val();
            var description = $('#project-description').val();
            $.ajax({
                url: '/projects',
                method: 'POST',
                data: {
                    name: projectName,
                    status: status,
                    client_id: client,
                    description: description,

                },
                success: function(response) {
                    $('#addProjectModal').modal('hide');
                    window.location.reload();
                },
                error: function(response) {
                    console.log('Error', response.responseText);
                }
            });
        });
        $(document).on('click', '.delete-comment', function() {
            var commentId = $(this).data('id');

            $.ajax({
                url: '/comments/' + commentId,
                method: 'DELETE',
                success: function(response) {
                    loadComments(currentProjectId);
                },
                error: function(response) {
                    console.log('Error', response.responseText);
                }
            });
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
                var header = `<h3>Tareas del proyecto</h3>`;
                var commentButton = $('<button class="btn btn-info mr-2">')
                .text('Agregar comentario al Proyecto')
                .on('click', function() {
                    $('#commentModal').modal('show');
                });
                var seeComments = $('<button class="btn btn-warning">')
                .text('Ver comentarios del Proyecto')
                .on('click', function() {
                    loadComments(projectId);
                });
                var paidAmount = response.invoices.paid.length > 0 ? response.invoices.paid[0].amount : 0;
                var pendingAmount = response.invoices.pending.length > 0 ? response.invoices.pending[0].amount : 0;
                var totalAmount = parseFloat(paidAmount) + parseFloat(pendingAmount);
                var totalInvoices = response.invoices.total > 0 ? response.invoices.total : 0;
                var invoices = `<div class="row">
                    <div class="col">
                        <h5><span class="badge bg-primary text-white">Total de facturas:</span> <span id="totalInvoices"></span></h5>
                    </div>
                    <div class="col">
                        <h5><span class="badge bg-primary text-white">Monto total:</span> <span id="totalAmount"></span></h5>
                    </div>
                    <div class="col">
                        <h5><span class="badge bg-success text-white">Monto pagado:</span> <span id="paidAmount"></span></h5>
                    </div>
                    <div class="col">
                        <h5><span class="badge bg-danger text-white">Monto pendiente:</span> <span id="pendingAmount"></span></h5>
                    </div>
                </div>`;
                var addTaskButton = $('<button class="btn btn-primary">')
                .text('Agregar tarea')
                .on('click', function() {
                    $('#taskModal').modal('show');
                });

                
                
                modalBody.append(invoices);
                modalBody.append(commentButton);
                modalBody.append(seeComments);
                modalBody.append(header);
                modalBody.append(addTaskButton);
                $('#totalInvoices').text(totalInvoices);
                $('#totalAmount').text(totalAmount);
                $('#paidAmount').text(paidAmount);
                $('#pendingAmount').text(pendingAmount);

                var row = $('<div class="row"> ');
                modalBody.append(row);
    
                var pendingTasks = $('<div class="col">').append('<h5>Pendiente</h5>');
                var inProgressTasks = $('<div class="col">').append('<h5>En Progreso</h5>');
                var completedTasks = $('<div class="col">').append('<h5>Completado</h5>');
    
                if (response.tasks.pending) {
                    response.tasks.pending.forEach(function(task) {
                        pendingTasks.append(createTaskHtml(task));
                    });
                }
    
                if (response.tasks.in_progress) {
                    response.tasks.in_progress.forEach(function(task) {
                        inProgressTasks.append(createTaskHtml(task));
                    });
                }
    
                if (response.tasks.completed) {
                    response.tasks.completed.forEach(function(task) {
                        completedTasks.append(createTaskHtml(task));
                    });
                }
    
                row.append(pendingTasks);
                row.append(inProgressTasks);
                row.append(completedTasks);
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
                    <option value="pending"${task.status === 'pending' ? ' selected' : ''}>Pendiente</option>
                    <option value="in_progress"${task.status === 'in_progress' ? ' selected' : ''}>En progreso</option>
                    <option value="completed"${task.status === 'completed' ? ' selected' : ''}>Completado</option>
                </select>
            </div>
        `;
    }

    function loadComments(projectId){
        $.ajax({
            url: '/projects/' + projectId + '/comments',
            method: 'GET',
            success: function(response) {
                console.log('Response', response);
                var modal = $('#projectModal');
                var modalBody = modal.find('.modal-body');
                modalBody.empty();
                var commentButton = $('<button class="btn btn-info mr-2">')
                .text('Agregar comentario al proyecto')
                .on('click', function() {
                    $('#commentModal').modal('show');
                });
                var goBackButton = $('<button class="btn btn-warning">')
                .text('Volver')
                .on('click', function() {
                    loadProjectTasks(projectId);
                });
                modalBody.append(commentButton);
                modalBody.append(goBackButton);
                var row = $('<div class="row">');
                modalBody.append(row);
    
                var comments = $('<div class="col">').append('<h5>Comentarios del Proyecto</h5>');
                console.log(response);
                if (response.comments) {
                    response.comments.forEach(function(comment) {
                        comments.append(createCommentHtml(comment));
                    });
                }
    
                row.append(comments);
                $('.select2').select2();
                modal.modal('show');
            },
            error: function(response) {
                console.log('Error', response.responseText);
            }
        });
    }

    function createCommentHtml(comment) {
        return `
            <div class="alert alert-info d-flex justify-content-between">
                ${comment.comment}
                <div>
                    <button class="btn btn-danger btn-sm delete-comment" data-id="${comment.id}">Eliminar</button>
                </div>
            </div>
        `;
    }
</script>
@endsection
