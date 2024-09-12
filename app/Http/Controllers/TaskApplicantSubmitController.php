<?php

namespace App\Http\Controllers;

use App\Models\TaskApplicantSubmit;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskApplicantSubmitController extends Controller
{

    public function create($task_id)
    {
        return view('dashboard.task_applicants.create', compact('task_id'));
    }


    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'proof' => 'required|string',
        ]);
        $request->merge(['status' => 'complete']);
        $request->merge(['user_id' => $user->id]);

        TaskApplicantSubmit::create($request->all());

        $task = Task::findOrFail($request->task_id);
        $projectApplicant = $task->project->applicants()->where('freelancer_id', $user->id)->first();

        return redirect()->route('dashboard.proposal_details', [
            'project' => $task->project_id,
            'projectApplicant' => $projectApplicant->id,
        ])
            ->with('success', 'Task Applicant Submission created successfully.');
    }

    public function edit(TaskApplicantSubmit $taskApplicantSubmit)
    {
        return view('task_applicants.edit', compact('taskApplicantSubmit'));
    }

    public function update(Request $request, TaskApplicantSubmit $taskApplicantSubmit)
    {
        $request->validate([
            'proof' => 'required|string',
            'status' => 'required|in:onprogress,complete',
        ]);

        $taskApplicantSubmit->update($request->all());

        return redirect()->route('task_applicants.index')
            ->with('success', 'Task Applicant Submission updated successfully.');
    }
}

