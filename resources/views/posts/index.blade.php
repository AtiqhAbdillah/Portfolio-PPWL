@extends('layouts.app')

@section('title', 'Projects - Portfolio')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Portfolio</p>
            <h1>My Projects</h1>
            <p class="intro">Beberapa project yang sedang saya bangun.</p>
        </div>
        <a class="button" href="{{ route('posts.create') }}">+ Add project</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse ($projects as $project)
        <article class="project-card">
            <div class="project-card__content">
                <p class="project-card__label">Project</p>
                <h2><a href="{{ route('posts.show', $project) }}">{{ $project->title }}</a></h2>
                <p>{{ $project->description }}</p>
            </div>
            <div class="project-card__actions">
                <a href="{{ route('posts.show', $project) }}">View details</a>
                <a href="{{ route('posts.edit', $project) }}">Edit</a>
                <form method="POST" action="{{ route('posts.destroy', $project) }}" onsubmit="return confirm('Yakin ingin menghapus project ini?');">
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
@endsection
