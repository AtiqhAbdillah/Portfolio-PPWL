@extends('layouts.app')

@section('title', $project->title . ' - Portfolio')

@section('content')
    <h1>{{ $project->title }}</h1>
    <p>{{ $project->description }}</p>
    <p>
        <a href="{{ route('posts.edit', $project) }}">Edit project</a> |
        <a href="{{ route('posts.index') }}">Back to projects</a>
    </p>
@endsection