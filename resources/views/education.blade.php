@extends('layouts.app')

@section('content')
    <h1>Perjalanan belajar</h1>
    <p>Beberapa hal yang sedang saya pelajari dan kembangkan.</p>
    <h2>Teknologi informasi</h2>
    <p>Memperdalam pengembangan web, database, dan cara membuat aplikasi yang bermanfaat.</p>
@endsection

@push('scripts')
    <script>console.log('education loaded');</script>
@endpush