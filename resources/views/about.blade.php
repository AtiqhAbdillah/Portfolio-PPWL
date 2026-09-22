@extends('layouts.app')

@section('title', 'Home - Portfolio')

@section('content')
    <h1>Tentang saya</h1>
    <p>Saya senang membangun pengalaman digital yang rapi, mudah digunakan, dan punya tujuan yang jelas.</p>
@endsection

@push('scripts')
    <script>console.log('about loaded');</script>
@endpush