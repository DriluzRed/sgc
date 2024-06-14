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

    
}
