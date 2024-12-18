<!-- resources/views/partials/navbar.blade.php -->
<link href="{{ asset('css/vapor.bootstrap.min.css') }}" rel="stylesheet">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand">
            Your Personal Project Apps
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                {{-- Navbar untuk Administrator --}}
                @if(auth()->check() && auth()->user()->hasRole('Administrator'))
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('dashboard')) active @endif"
                        href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('projects.index')) active @endif" href="{{ route('projects.index') }}">Projects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('admin.users.index')) active @endif" href="{{ url('admin/users') }}">Users</a>
                </li>
                @else
                {{-- Navbar untuk User Biasa --}}
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('dashboard')) active @endif" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('projects.index')) active @endif" href="{{ route('projects.index') }}">Projects</a>
                </li>
                @endif
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link" style="display: inline; cursor: pointer;">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>