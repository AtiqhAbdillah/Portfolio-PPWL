@extends('layouts.app')

@section('title', 'Trash - Portfolio')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Portfolio</p>
            <h1>Trash</h1>
            <p class="intro">Project yang dihapus bisa dipulihkan atau dihapus permanen.</p>
        </div>
        <a class="button" href="{{ route('posts.index') }}">Back to projects</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse ($projects as $project)
        <article class="project-card">
            <div class="project-card__content">
                <p class="project-card__label">Deleted project</p>
                <h2>{{ $project->title }}</h2>
                <p>{{ $project->description }}</p>
            </div>
            <div class="project-card__actions">
                <form method="POST" action="{{ route('posts.restore', $project->id) }}">
                    @csrf
                    @method('PATCH')
                    <button class="button-link" type="submit">Restore</button>
                </form>
                <form method="POST" action="{{ route('posts.force-delete', $project->id) }}"
                    onsubmit="return confirm('Hapus project ini secara permanen?');">
                    @csrf
                    @method('DELETE')
                    <button class="button-link button-danger" type="submit">Delete permanently</button>
                </form>
            </div>
        </article>
    @empty
        <div class="empty-state">
            <h2>Trash is empty</h2>
            <p>Tidak ada project yang dihapus.</p>
        </div>
    @endforelse
@endsection
