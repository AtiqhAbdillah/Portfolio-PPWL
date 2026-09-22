@extends('layouts.app')

@section('title', 'Home - Portfolio')

@section('content')
    <div class="container">
        <h1>Projects</h1>

        @forelse ($projects as $project)
            <article>
                <h2><a href="{{ route('posts.show', $project) }}">{{ $project->title }}</a></h2>
                <p>{{ $project->description }}</p>
            </article>
        @empty
            <p>No projects found.</p>
        @endforelse
    </div>
@endsection

@push('scripts')
    <script>console.log('projects loaded');</script>
@endpush