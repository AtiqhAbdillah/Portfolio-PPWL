<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'per_page' => ['nullable', 'integer', Rule::in([5, 10, 25])],
        ]);
        $search = $filters['search'] ?? '';
        $perPage = (int) ($filters['per_page'] ?? 10);

        return view('posts.index', [
            'projects' => Project::query()
                ->when($search !== '', function ($query) use ($search): void {
                    $query->where('title', 'like', "%{$search}%");
                })
                ->latest()
                ->paginate($perPage)
                ->withQueryString(),
            'search' => $search,
            'perPage' => $perPage,
        ]);
    }

    public function trash(): View
    {
        return view('posts.trash', [
            'projects' => Project::onlyTrashed()->latest('deleted_at')->get(),
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
            'status' => ['required', 'in:draft,published'],
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
            'status' => ['required', 'in:draft,published'],
        ]);

        $project->update($validated);

        return redirect()->route('posts.show', $project);
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return redirect()->route('posts.index')->with('success', 'Project berhasil dihapus.');
    }

    public function restore(int $project): RedirectResponse
    {
        $trashedProject = Project::onlyTrashed()->findOrFail($project);
        $trashedProject->restore();

        return redirect()->route('posts.trash')->with('success', 'Project berhasil dipulihkan.');
    }

    public function permanentlyDelete(int $project): RedirectResponse
    {
        $trashedProject = Project::onlyTrashed()->findOrFail($project);
        $trashedProject->forceDelete();

        return redirect()->route('posts.trash')->with('success', 'Project berhasil dihapus permanen.');
    }
}
