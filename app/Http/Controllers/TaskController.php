<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class TaskController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        $this->authorize('update', $project);

        return view('tasks.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request, Project $project)
    {
        $this->authorize('update', $project);

        $validated = $request->validated();

        try {
            $project->tasks()->create($validated);
        } catch (Throwable $e) {
            Log::error('Failed to create task: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Something went wrong while adding the task. Please try again.');
        }

        return redirect()->route('projects.show', $project)->with('success', 'Task added!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);

        $validated = $request->validated();
        $wasNotDone = $task->status !== 'Done';

        try {
            $task->update($validated);
        } catch (Throwable $e) {
            Log::error('Failed to update task: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Something went wrong while updating the task. Please try again.');
        }

        if ($wasNotDone && $task->status === 'Done') {
            return redirect()->route('projects.show', $task->project)
                ->with('task_done', $task->title);
        }

        return redirect()->route('projects.show', $task->project)->with('success', 'Task updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $project = $task->project;

        try {
            $task->delete();
        } catch (Throwable $e) {
            Log::error('Failed to delete task: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong while deleting the task. Please try again.');
        }

        return redirect()->route('projects.show', $project)->with('success', 'Task deleted!');
    }
}