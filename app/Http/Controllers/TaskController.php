<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create($projectId)
    {
        $project = Project::findOrFail($projectId);
        return view('admin.tasks.create', compact('project'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:2045',
            'project_id' => 'required|exists:projects,id',
        ]);

        Task::create($request->all());

        return redirect()->route('admin.projects.show', $request->project_id)
                         ->with('success', 'Task created successfully.');
    }

    public function edit(Task $task)
    {
        $project = $task->project; // Assuming a task belongs to a project
        return view('admin.tasks.edit', compact('task', 'project'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:2045',
        ]);

        $task->update($request->all());

        return redirect()->route('admin.projects.show', $task->project_id)
                         ->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $projectId = $task->project_id; // Assuming the task belongs to a project
        $task->delete();

        return redirect()->route('admin.projects.show', $projectId)
                         ->with('success', 'Task deleted successfully.');
    }
}
