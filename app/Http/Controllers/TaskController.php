<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use App\Models\Task;

class TaskController extends Controller
{
    public function create(Project $project)
    {
        $this->authorize('view', $project);

        return view('tasks.create', compact('project'));
    }

    public function store(StoreTaskRequest $request, Project $project)
    {
        $this->authorize('view', $project);
        $project->tasks()->create($request->validated());

        return redirect()->route('projects.show', $project)->with('success', 'Task created.');
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        return view('tasks.edit', compact('task'));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);
        $task->update($request->validated());

        return redirect()->route('projects.show', $task->project)->with('success', 'Task updated.');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $project = $task->project;
        $task->delete();

        return redirect()->route('projects.show', $project)->with('success', 'Task deleted.');
    }
}
