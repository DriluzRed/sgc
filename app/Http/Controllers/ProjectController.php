<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $statuses = [
            Project::STATUS_PENDING => 'Pendientes',
            Project::STATUS_IN_PROGRESS => 'En Progreso',
            Project::STATUS_COMPLETED => 'Hecho',
        ];
        $colors = [
            'pending' => 'bg-danger',
            'in_progress' => 'bg-primary',
            'completed' => 'bg-success',
        ];
        $projects = Project::all()->groupBy('status');
        return view('pages.projects.index')->with('projects', $projects)->with('statuses', $statuses)->with('colors', $colors);
    }

    public function updateStatus(Request $request, Project $project)
    {
        $project->status = $request->status;
        $project->save();
        return redirect()->route('projects.index');
    }

    public function getTasks(Project $project)
    {
        return response()->json($project->tasks->groupBy('status'));
    }

    public function comments(Request $request, $project)
    {
        $project = Project::find($project);
        $project->comments()->create([
            'project_id' => $project->id,
            'comment' => $request->input('comment'),
            'user_id' => auth()->user()->id,
        ]);

        return response()->json(['message' => 'Comentario creado', 'project_id' => $project->project_id]);
    }

    public function getComments(Project $project)
    {
        return response()->json(['message', 'Comentarios obtenidos', 'comments' => $project->comments]);
    }
}
