<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        return view('posts.index', [
            'projects' => Project::latest()->get(),
        ]);
    }

    public function create(): View
    {
        return view('posts.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:255'],
            'description' => ['required', 'string', 'min:10'],
        ]);

        Project::create($validated);

        return redirect()->route('posts.index')->with('success', 'Project berhasil ditambahkan.');
    }

    public function show(Project $project): View
    {
        return view('posts.show', compact('project'));
    }

    public function edit(Project $project): View
    {
        return view('posts.edit', compact('project'));
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:255'],
            'description' => ['required', 'string', 'min:10'],
        ]);

        $project->update($validated);

        return redirect()->route('posts.show', $project);
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return redirect()->route('posts.index')->with('success', 'Project berhasil dihapus.');
    }
}
