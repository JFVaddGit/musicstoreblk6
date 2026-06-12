<x-app-layout>
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

                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </body>
</x-app-layout>