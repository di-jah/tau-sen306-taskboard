<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = auth()->user()->projects()->latest()->get();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $validated = $request->validated();

        auth()->user()->projects()->create($validated);

        return redirect()->route('projects.index')->with('success', 'Project created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Project $project)
    {
        $this->authorize('view', $project);

        $status = $request->query('status');

        $tasks = $project->tasks()
            ->when($status, fn ($query) => $query->where('status', $status))
            ->latest()
            ->get();

        return view('projects.show', compact('project', 'tasks', 'status'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $this->authorize('update', $project);

        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProjectRequest $request, Project $project)
    {
        $this->authorize('update', $project);

        $validated = $request->validated();

        $project->update($validated);

        return redirect()->route('projects.index')->with('success', 'Project updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);

        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted!');
    }
}