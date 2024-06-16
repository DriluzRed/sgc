<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Client;
use App\Models\Comment;
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
        $clients = Client::all();
        $projects = Project::all()->groupBy('status');
        return view('pages.projects.index')->with('projects', $projects)->with('statuses', $statuses)->with('colors', $colors)->with('clients', $clients);
    }

    public function updateStatus(Request $request, Project $project)
    {
        $project->status = $request->status;
        $project->save();
        return redirect()->route('projects.index');
    }

    public function getTasks(Project $project)
    {
        $invoices = $project->invoices->groupBy('status');
        $invoicesData = [
            'total' => $invoices->count(),
        ];
        foreach ($invoices as $status => $invoiceGroup) {
            $invoicesData[$status] = $invoiceGroup;
        }
        $tasks = $project->tasks->groupBy('status');
        return response()->json([
            'tasks' => $tasks,
            'invoices' => $invoicesData
        ]);
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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'client_id' => 'required',
            'status' => 'required',
        ]);

        Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => Project::STATUS_PENDING,
            'client_id' => $request->client_id,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('projects.index');
    }

    public function deleteComment($comment)
    {
        $comment = Comment::find($comment);
        $comment->delete();
        return response()->json(['message' => 'Comentario eliminado']);
    }
}
