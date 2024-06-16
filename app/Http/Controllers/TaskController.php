<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function updateStatus(Request $request, $task)
    {
        $task = Task::find($task);
        $task->status = $request->input('status');
        $task->save();

        return response()->json(['message' => 'Estado actualizado', 'project_id' => $task->project_id]);
    }

    public function store(Request $request, $project)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $task = new Task();
        $task->name = $request->name;
        $task->description = $request->description;
        $task->due_date = $request->due_date;
        $task->project_id = $project;
        $task->status = $request->status;
        $task->save();

        return response()->json(['message' => 'Tarea creada', 'project_id' => $project]);
    }
    
}
