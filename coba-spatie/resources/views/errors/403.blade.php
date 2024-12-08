@extends('layouts.error')

@section('title', '403 Forbidden')

@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Manajemen Proyek')</title>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/vapor.bootstrap.min.css') }}" rel="stylesheet">
</head>
<div class="container text-center mt-5">
    <h1 class="display-1">403</h1>
    <p class="lead">You don't have permission to access this page.</p>

    <!-- Tombol Logout -->
    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>

    <!-- Tombol Kembali ke Halaman Utama -->
    <a href="{{ url('/') }}" class="btn btn-primary">Go to Homepage</a>
</div>
@endsection