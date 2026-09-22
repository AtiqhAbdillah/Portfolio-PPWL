@extends('layouts.app')

@section('content')
    <h1>Add Project</h1>
    <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        <p>
            <label for="title">Title</label><br>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required>
            @error('title') <br>{{ $message }} @enderror
        </p>
        <p>
            <label for="description">Description</label><br>
            <textarea id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
            @error('description') <br>{{ $message }} @enderror
        </p>
        <button type="submit">Submit</button>
        <a href="{{ route('posts.index') }}">Cancel</a>
    </form>
@endsection