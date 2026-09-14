@extends('layouts.app')

@section('title', 'Home - Portfolio')

@section('content')
    <h1>Selamat Datang</h1>
    <p>Ini adalah halaman about.</p>
@endsection

@push('scripts')
    <script>console.log('about loaded');</script>
@endpush