@extends('layouts.app')

@section('title', 'Edit Project - Portfolio')

@section('content')
    <h1>Edit Project</h1>
    <form method="POST" action="{{ route('posts.update', $project) }}">
        @csrf
        @method('PUT')
        <p>
            <label for="title">Title</label><br>
            <input type="text" id="title" name="title" value="{{ old('title', $project->title) }}" required>
            @error('title') <br>{{ $message }} @enderror
        </p>
        <p>
            <label for="description">Description</label><br>
            <textarea id="description" name="description" rows="5" required>{{ old('description', $project->description) }}</textarea>
            @error('description') <br>{{ $message }} @enderror
        </p>
        <button type="submit">Save</button>
        <a href="{{ route('posts.show', $project) }}">Cancel</a>
    </form>
@endsection
