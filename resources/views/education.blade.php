@extends('layouts.app')

@section('content')
    <h1>Selamat Datang</h1>
    <p>Ini adalah halaman education.</p>
@endsection

@push('scripts')
    <script>console.log('education loaded');</script>
@endpush