<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h2 class="font-bold text-xl text-gray-800 dark:text-gray-100 leading-tight uppercase">Albums</h2>
                <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">Browse and manage all albums.</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('albums.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">Add Album</a>
                <a href="{{ route('tracks.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">Add Track</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @php
            $genresList = \App\Models\Genre::all();
            $selectedGenres = request()->query('genres', []);
            $selectedGenres = array_map('intval', (array) $selectedGenres);
            @endphp

            <div class="mb-4">
                <div class="bg-white shadow-sm rounded-lg p-4">
                    <form method="get" class="flex flex-wrap items-center gap-4">
                        <label class="text-sm font-medium text-gray-700">Filteren op genre</label>
                        <div class="flex flex-wrap gap-2">
                            @foreach($genresList as $genre)
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="genres[]" value="{{ $genre->id }}" {{ in_array($genre->id, $selectedGenres) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 cursor-pointer">
                                <span class="ml-2 text-sm text-gray-700">{{ $genre->name }}</span>
                            </label>
                            @endforeach
                        </div>

                        <div class="flex items-center gap-1">
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded text-sm hover:bg-indigo-700">Toepassen</button>
                            <a href="{{ url('albums') }}" class="px-4 py-2 text-sm text-gray-600 hover:text-gray-900">Reset</a>
                        </div>
                    </form>
                </div>
            </div>
            @if(isset($albums) && $albums->count())
            <div class="grid gap-6 xl:grid-cols-2">
                @foreach($albums as $album)
                <div class="overflow-hidden rounded-xl bg-white dark:bg-slate-900 shadow-sm border border-slate-200 dark:border-slate-700">
                    @if($album->image_url)
                    <div class="h-48 overflow-hidden">
                        <img src="{{ $album->image_url }}" alt="{{ $album->title }}" class="w-full h-full object-cover" />
                    </div>
                    @else
                    <div class="h-48 bg-slate-100 dark:bg-slate-800 flex items-center justify-center">
                        <svg class="h-16 w-16 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7M8 7v8m8-8v8M3 7l9-4 9 4" />
                        </svg>
                    </div>
                    @endif
                    <div class="p-6">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm text-indigo-600 uppercase tracking-wide font-semibold">Album</p>
                                <h3 class="mt-2 text-xl font-semibold text-slate-900 dark:text-slate-100">{{ $album->title }}</h3>
                                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $album->artist->name ?? 'Unknown artist' }}</p>
                            </div>
                            <span class="inline-flex items-center rounded-full bg-slate-100 text-slate-700 px-3 py-1 text-xs font-semibold uppercase dark:bg-slate-800 dark:text-slate-200">
                                {{ $album->genre->name ?? 'No genre' }}
                            </span>
                        </div>

                        <div class="mt-4 grid gap-3 sm:grid-cols-3">
                            <div class="rounded-xl bg-slate-50 dark:bg-slate-800 p-3">
                                <p class="text-xs uppercase tracking-wide text-slate-500 dark:text-slate-400">Price</p>
                                <p class="mt-1 text-sm font-medium text-slate-900 dark:text-slate-100">€{{ number_format(floatval($album->price), 2, ',', '.') }}</p>
                            </div>
                            <div class="rounded-xl bg-slate-50 dark:bg-slate-800 p-3">
                                <p class="text-xs uppercase tracking-wide text-slate-500 dark:text-slate-400">Stock</p>
                                <p class="mt-1 text-sm font-medium text-slate-900 dark:text-slate-100">{{ $album->stock }}</p>
                            </div>
                            <div class="rounded-xl bg-slate-50 dark:bg-slate-800 p-3">
                                <p class="text-xs uppercase tracking-wide text-slate-500 dark:text-slate-400">Released</p>
                                <p class="mt-1 text-sm font-medium text-slate-900 dark:text-slate-100">{{ optional($album->release_year)->format('d-m-Y') ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="{{ route('albums.show', $album) }}" class="inline-flex items-center px-3 py-2 rounded-lg bg-slate-100 text-slate-700 hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-100 dark:hover:bg-slate-700 text-sm font-medium">View</a>
                            <a href="{{ route('albums.edit', $album) }}" class="inline-flex items-center px-3 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 text-sm font-medium">Edit</a>
                            <form action="{{ route('albums.destroy', $album) }}" method="POST" class="inline-block" onsubmit="return confirm('Weet je zeker dat je dit album wilt verwijderen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-3 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 text-sm font-medium">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="overflow-hidden rounded-lg bg-white dark:bg-slate-900 shadow">
                <div class="p-6 text-slate-700 dark:text-slate-100">
                    <p class="text-lg font-semibold">Er zijn nog geen albums toegevoegd.</p>
                    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Use the button above to create your first album.</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>