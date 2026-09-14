@extends('layouts.app')

@section('title', 'Home - Portfolio')

@section('content')
    <h1>Selamat Datang</h1>
    <p>Ini adalah halaman projects.</p>
@endsection

@push('scripts')
    <script>console.log('projects loaded');</script>
@endpush