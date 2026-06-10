<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')




        <div class="flex">
            <!-- Sidebar -->
            <aside class="w-64 bg-white border-r border-slate-200 shadow min-h-screen">
                <!-- Sidebar content goes here -->

                <!-- navigation links -->
                <nav class="p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Navigation</h2>
                    <!-- separation line -->
                    <hr class="mb-4">
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('albums.index') }}" class="block text-gray-700 hover:text-gray-900 {{ request()->routeIs('albums.*') ? 'font-bold' : '' }}">Albums</a>
                        </li>
                        <li>
                            <a href="{{ route('tracks.index') }}" class="block text-gray-700 hover:text-gray-900 {{ request()->routeIs('tracks.*') ? 'font-bold' : '' }}">Tracks</a>
                        </li>
                        <li>
                            <a href="{{ route('artists.index') }}" class="block text-gray-700 hover:text-gray-900 {{ request()->routeIs('artists.*') ? 'font-bold' : '' }}">Artists</a>
                        </li>

                        <!-- auth for genres and orders only show if user is admin -->
                        <!-- @if(auth()->user() && auth()->user()->is_admin) -->
                        <li>
                            <a href="{{ route('genres.index') }}" class="block text-gray-700 hover:text-gray-900 {{ request()->routeIs('genres.*') ? 'font-bold' : '' }}">Genres</a>
                        </li>
                        <li>
                            <a href="{{ route('orders.index') }}" class="block text-gray-700 hover:text-gray-900 {{ request()->routeIs('orders.*') ? 'font-bold' : '' }}">Orders</a>
                        </li>
                        <!-- @endif -->
                    </ul>
                </nav>

                <!-- filters -->
                @if(request()->routeIs('albums.index'))
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Search & Filter</h2>
                    <!-- separation line -->
                    <hr class="mb-4">
                    <form method="get" action="{{ route('albums.index') }}" class="space-y-4">
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                            <input type="text" name="search" id="search" value="{{ request()->query('search', '') }}" class="mt-1 block w-full border rounded px-3 py-2">
                        </div>
                        <!-- saparate line -->
                        <hr class="my-4">
                        <div>
                            <p class="block text-sm font-medium text-gray-700 mb-2">Genres</p>
                        </div>
                        <div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Apply filters</button>
                        </div>
                    </form>
                </div>
                @endif

                <!-- dark separation line -->
                <hr class="my-4">
            </aside>






            <!-- Main Content Area -->
            <div class="flex-1">
                <!-- Page Heading -->
                @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
                @endisset

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
</body>

</html>