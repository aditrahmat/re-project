<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Manajemen Proyek')</title>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/vapor.bootstrap.min.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Main Content -->
    <div class="container mt-4">
        @yield('content')
    </div>
    <footer class="bg-light text-center py-3">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} Manager Aplikasi. All Rights Reserved.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>