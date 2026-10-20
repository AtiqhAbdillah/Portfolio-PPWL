@extends('layouts.app')

@section('title', 'Projects - Portfolio')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Portfolio</p>
            <h1>My Projects</h1>
            <p class="intro">Beberapa project yang sedang saya bangun.</p>
        </div>
        <div>
            <a class="button" href="{{ route('posts.trash') }}">Trash</a>
            <a class="button" href="{{ route('posts.create') }}">+ Add project</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form class="project-filters" method="GET" action="{{ route('projects') }}">
        <label for="search">
            Search projects
            <input type="search" id="search" name="search" value="{{ $search }}"
                placeholder="Search by title">
        </label>

        <label for="per_page">
            Projects per page
            <select id="per_page" name="per_page">
                @foreach ([5, 10, 25] as $option)
                    <option value="{{ $option }}" @selected($perPage === $option)>
                        {{ $option }} per page
                    </option>
                @endforeach
            </select>
        </label>

        <div class="project-filters__actions">
            <button type="submit">Search</button>
            @if ($search !== '')
                <a class="button button-secondary" href="{{ route('projects') }}">Clear</a>
            @endif
        </div>
    </form>

    @forelse ($projects as $project)
        <article class="project-card">
            <div class="project-card__content">
                <p class="project-card__number">No. {{ $projects->firstItem() + $loop->index }}</p>
                <p class="project-card__label">Project</p>
                <h2><a href="{{ route('posts.show', $project) }}">{{ $project->title }}</a></h2>
                <p>{{ $project->description }}</p>
                <p>Status: {{ ucfirst($project->status) }}</p>
            </div>
            <div class="project-card__actions">
                <a href="{{ route('posts.show', $project) }}">View details</a>
                <a href="{{ route('posts.edit', $project) }}">Edit</a>
                <form method="POST" action="{{ route('posts.destroy', $project) }}" onsubmit="return confirm
                ('Yakin ingin menghapus project ini?');">
                    @csrf
                    @method('DELETE')
                    <button class="button-link button-danger" type="submit">Delete</button>
                </form>
            </div>
        </article>
    @empty
        <div class="empty-state">
            <h2>No projects found</h2>
            <p>Mulai tambahkan project pertama kamu.</p>
            <a class="button" href="{{ route('posts.create') }}">Add project</a>
        </div>
    @endforelse

    <div class="project-index__meta">
        Halaman: {{ $projects->currentPage() }} / {{ $projects->lastPage() }}<br>
        Jumlah data: {{ $projects->total() }}<br>
        Data per halaman: {{ $projects->perPage() }}
    </div>

    <div class="project-pagination">
        {{ $projects->links() }}
    </div>
@endsection
