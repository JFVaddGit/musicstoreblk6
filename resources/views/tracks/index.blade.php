<x-app-layout>
    @php
    $genresList = \App\Models\Genre::all();
    $selectedGenres = array_map('intval', (array) request()->query('genres', []));
    $search = request()->query('search', '');
    @endphp


    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h1 class="font-bold text-xl text-gray-800 dark:text-gray-100 uppercase">Tracks</h1>
                @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isEmployee()))
                    <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">Create, edit, and manage tracks.</p>
                @else
                    <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">View tracks.</p>
                @endif
            </div>




            <div class="flex flex-wrap gap-2 items-center">
                <form method="get" action="{{ route('tracks.index') }}" class="flex items-center gap-2">
                    <!-- input for searching albums by title or artist name, keep the selected genres in the query when searching -->
                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Search tracks or artist"
                        class="w-72 rounded-lg border border-slate-400 bg-white px-3 py-2 text-sm text-slate-700 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200" />
                    @foreach($selectedGenres as $genreId)
                        <input type="hidden" name="genres[]" value="{{ $genreId }}" />
                    @endforeach
                    <button type="submit" class="inline-flex items-center px-4 py-2 rounded-lg border border-slate-400 bg-white text-slate-700 hover:bg-slate-50 text-sm">
                        Search</button>
                </form>
                
                <x-dropdown align="right" width="64">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 bg-slate-600 text-white rounded-lg shadow hover:bg-slate-700 transition">
                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filter
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <form method="get" class="px-4 py-3" @click.stop>
                            <input type="hidden" name="search" value="{{ $search }}" />
                            <div class="space-y-2">
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Filter by Genre</p>
                                @foreach($genresList as $genre)
                                    <label class="flex items-center">
                                        <input
                                            type="checkbox"
                                            name="genres[]"
                                            value="{{ $genre->id }}"
                                            {{ in_array($genre->id, $selectedGenres) ? 'checked' : '' }}
                                            class="rounded border-gray-300 text-indigo-600 cursor-pointer">

                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                                            {{ $genre->name }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                            <div class="mt-4 flex gap-2">
                                <button type="submit" class="flex-1 px-3 py-2 bg-indigo-600 text-white rounded text-sm hover:bg-indigo-700">Apply</button>
                                <a href="{{ route('tracks.index') }}" class="flex-1 px-3 py-2 text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 text-center border border-gray-300 dark:border-gray-600 rounded">Reset</a>
                            </div>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="flex gap-2">
                @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isEmployee()))
                <a href="{{ route('albums.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">NEW ALBUM</a>
                <a href="{{ route('tracks.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">NEW TRACK</a>
                @endif
            </div>
        </div>
    </x-slot>



    <body class="bg-gray-50 text-gray-800">
        <div class="py-12">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                @if(isset($tracks) && $tracks->count())
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($tracks as $track)
                    <div class="rounded-xl bg-white shadow border border-slate-200 p-6">

                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-slate-900">
                                    {{ $track->title }}
                                </h3>

                                <p class="text-sm text-slate-500">
                                    {{ $track->artist->name ?? 'Unknown Artist' }}
                                </p>
                            </div>

                            <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                                #{{ $track->track_number ?? '-' }}
                            </span>
                        </div>

                        <div class="mt-4 space-y-2 text-sm">
                            <div>
                                <span class="font-medium">Album:</span>
                                {{ $track->album->title ?? '-' }}
                            </div>

                            <div>
                                <span class="font-medium">Genre:</span>
                                {{ $track->genre->name ?? '-' }}
                            </div>

                            <div>
                                <span class="font-medium">Duration:</span>
                                {{ $track->duration
                                    ? floor($track->duration / 60) . ':' . str_pad($track->duration % 60, 2, '0', STR_PAD_LEFT)
                                    : '-' }}
                            </div>
                        </div>

                        <!-- code for a view button can be added here if needed -->
                        <div class="mt-6 flex gap-3">
                            <a href="{{ route('tracks.show', $track) }}"
                            class="inline-flex items-center px-3 py-2 rounded-lg bg-blue-600
                                text-white hover:bg-blue-700 text-sm">
                                    View
                            </a>
                        </div>

                        @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isEmployee()))
                        <div class="mt-6 flex gap-3">
                            <a href="{{ route('tracks.edit', $track) }}"
                            class="inline-flex items-center px-3 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 text-sm">
                                Edit
                            </a>

                            <form action="{{ route('tracks.destroy', $track) }}"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this track?');">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="inline-flex items-center px-3 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 text-sm">
                                    Delete
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </body>
</x-app-layout>