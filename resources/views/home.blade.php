@extends('layouts.app')

@section('title', 'Home - Portfolio')

@section('content')
    <h1>Selamat datang di ruang karya saya.</h1>
    <p>Tempat sederhana untuk mengenal perjalanan, pendidikan, dan project yang sedang saya kerjakan.</p>
    <p>
        <a href="{{ route('projects') }}">Lihat project</a> |
        <a href="{{ route('about') }}">Tentang saya</a>
    </p>
@endsection

@push('scripts')
    <script>console.log('home loaded');</script>
@endpush