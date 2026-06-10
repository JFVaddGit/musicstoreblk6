<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ $album->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center gap-2 mb-4 text-sm text-slate-600 dark:text-slate-300">
                <a href="{{ route('albums.index') }}" class="inline-flex items-center gap-2 text-slate-700 dark:text-slate-200 hover:text-slate-900 dark:hover:text-white">
                    <span class="text-xl leading-none">&larr;</span>
                    <span>Back to Albums</span>
                </a>
            </div>

            <div class="bg-white dark:bg-slate-900 overflow-hidden rounded-lg shadow">
                <div class="relative h-72 bg-slate-100 dark:bg-slate-800 overflow-hidden">
                    @if($album->image_url)
                    <img src="{{ $album->image_url }}" alt="{{ $album->title }}" class="w-full h-full object-cover" />
                    @else
                    <div class="flex h-full w-full items-center justify-center text-slate-400 dark:text-slate-500">
                        <svg class="h-16 w-16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7M8 7v8m8-8v8M3 7l9-4 9 4" />
                        </svg>
                    </div>
                    @endif
                </div>
                <div class="p-6">
                    <p class="text-sm text-slate-500 dark:text-slate-400">{{ $album->artist->name ?? 'Unknown artist' }} • {{ $album->genre->name ?? 'No genre' }}</p>
                    <h1 class="mt-6 text-2xl font-bold text-slate-900 dark:text-slate-100">{{ $album->title }}</h1> <!-- button to edit the album, only for admin and employee -->
                    @if(auth()->check() && auth()->user()->isAdmin())
                    <div class="mt-4">
                        <a href="{{ route('albums.edit', $album) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-sm font-medium">Edit Album</a>
                    </div>
                    @endif
                    

                    <div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <div class="text-xs text-slate-500">Price</div>
                            <div class="font-medium">€{{ number_format($album->price, 2) }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-slate-500">Stock</div>
                            <div class="font-medium">{{ $album->stock }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-slate-500">Released</div>
                            <div class="font-medium">{{ optional($album->release_year)->format('d-m-Y') ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>

                <div class="border-t border-slate-200 dark:border-slate-700 p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
                        <div>
                            <h2 class="text-lg font-semibold text-slate-900 dark:text-slate-100">Tracks</h2>
                            <p class="text-sm text-slate-500 dark:text-slate-400">All tracks included on this album.</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="inline-flex items-center rounded-full bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 px-3 py-1 text-sm font-semibold">
                                {{ $album->tracks->count() }} track{{ $album->tracks->count() === 1 ? '' : 's' }}
                            </span>
                            <!-- auth so only admin and employee can see the add track button -->
                            @if(auth()->check() && auth()->user()->isAdmin())
                            <a href="{{ route('tracks.create', ['album_id' => $album->id]) }}" class="inline-flex items-center px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 text-sm font-semibold">Add Track</a>
                            @endif
                        </div>
                    </div>

                    @if($album->tracks->isEmpty())
                    <div class="rounded-xl bg-slate-50 dark:bg-slate-800 p-6 text-slate-700 dark:text-slate-300">
                        <p class="text-sm">No tracks have been added for this album yet.</p>
                    </div>
                    @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                            <thead class="bg-slate-50 dark:bg-slate-800">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">#</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Title</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Duration</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Genre</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Artist</th>
                                    @if(auth()->check() && auth()->user()->isAdmin())
                                    <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 dark:divide-slate-700 bg-white dark:bg-slate-900">
                                @foreach($album->tracks as $track)
                                <tr>
                                    <td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-300">{{ $track->track_number ?? $loop->iteration }}</td>
                                    <td class="px-4 py-3 text-sm text-slate-900 dark:text-slate-100">{{ $track->title }}</td>
                                    <td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-300">{{ $track->duration ?? '—' }}</td>
                                    <td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-300">{{ $track->genre->name ?? 'Unknown' }}</td>
                                    <td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-300">{{ $track->artist->name ?? 'Unknown' }}</td>
                                    @if(auth()->check() && auth()->user()->isAdmin())
                                    <td class="px-4 py-3 text-right text-sm">
                                        <div class="inline-flex items-center gap-2">
                                            <a href="{{ route('tracks.edit', $track) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">Edit</a>
                                            <form action="{{ route('tracks.destroy', $track) }}" method="POST" class="inline-flex" onsubmit="return confirm('Are you sure you want to delete this track?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>