@extends('layouts.app')

@section('title', 'Projects - Portfolio')

@section('content')
    <h1>Projects</h1>
    <p>Beberapa project yang sedang saya bangun.</p>
    <p><a href="{{ route('posts.create') }}">Add project</a></p>

    @forelse ($projects as $project)
            <article>
                <h2><a href="{{ route('posts.show', $project) }}">{{ $project->title }}</a></h2>
                <p>{{ $project->description }}</p>
                <a href="{{ route('posts.edit', $project) }}">Edit</a>
                <form method="POST" action="{{ route('posts.destroy', $project) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </article>
            <hr>
    @empty
        <p>No projects found.</p>
    @endforelse
@endsection
