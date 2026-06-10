<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h1 class="font-bold text-xl text-gray-800 dark:text-gray-100 uppercase">Add Track for {{ $selectedAlbum->title }}</h1>
                <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">Add a new track to this album.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ request()->query('album_id') ? route('albums.show', request()->query('album_id')) : route('albums.index') }}" class="inline-flex items-center gap-2 text-slate-700 dark:text-slate-200 hover:text-slate-900 dark:hover:text-white text-sm font-medium">
                    <span class="text-xl leading-none">&larr;</span>
                    <span>Back to album</span>
                </a>
            </div>
            <div class="bg-white dark:bg-slate-900 overflow-hidden rounded-3xl shadow border border-slate-200 dark:border-slate-700 p-6">
                <form action="{{ route('tracks.store') }}" method="post" class="space-y-4">
                    @csrf

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Title *</label>
                        <input type="text" name="title" id="title" required class="mt-1 block w-full border rounded px-3 py-2">
                    </div>

                    <input type="hidden" name="album_id" value="{{ $selectedAlbum->id }}" />
                    <div>
                        <p class="text-sm text-slate-800 dark:text-slate-200">
                            Adding a track to <strong>{{ $selectedAlbum->title }}</strong>
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm text-slate-700">Track nummer</p>
                            <p class="mt-2 text-lg font-semibold text-slate-900">{{ $nextTrackNumber }}</p>
                        </div>

                        <div>
                            <label for="duration" class="block text-sm font-medium text-gray-700">Duration (seconds)</label>
                            <input type="number" name="duration" id="duration" class="mt-1 block w-full border rounded px-3 py-2">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="genre_id" class="block text-sm font-medium text-gray-700">Genre</label>
                            <select name="genre_id" id="genre_id" class="mt-1 block w-full border rounded px-3 py-2">
                                <option value="">-- Choose a genre --</option>
                                @foreach($genres as $genre)
                                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="artist_id" class="block text-sm font-medium text-gray-700">Artist</label>
                            <select name="artist_id" id="artist_id" class="mt-1 block w-full border rounded px-3 py-2">
                                <option value="">-- Choose an artist --</option>
                                @foreach($artists as $artist)
                                <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Add track</button>
                        <!-- redirect back to the album view the track will belong to after creation instead of the track index -->
                        <a href="{{ request()->query('album_id') ? route('albums.show', request()->query('album_id')) : route('albums.index') }}" class="ml-3 text-sm text-gray-600">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>