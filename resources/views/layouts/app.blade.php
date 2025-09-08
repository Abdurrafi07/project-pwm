<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
</head>
<body class="d-flex flex-column min-vh-100 font-sans antialiased bg-gray-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
        <div class="container">
            @guest
                <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                    <i class="fas fa-shield-alt me-2"></i>{{ config('app.name', 'Public App') }}
                </a>
            @endguest

            @auth
                @if(auth()->user()->isUser())
                    <a class="navbar-brand fw-bold" href="{{ route('user.dashboard') }}">
                        <i class="fas fa-shield-alt me-2"></i>{{ config('app.name', 'User Dashboard') }}
                    </a>
                @elseif(auth()->user()->isAdmin())
                    <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-shield-alt me-2"></i>{{ config('app.name', 'Admin Panel') }}
                    </a>
                @endif
            @endauth

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                @include('layouts.navbar')
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow-1 py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-primary text-white text-center py-3 mt-auto">
        <small>&copy; {{ date('Y') }} {{ config('app.name', 'Multi-Role App') }}. All rights reserved.</small>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
