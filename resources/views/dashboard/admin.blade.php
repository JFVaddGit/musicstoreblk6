<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h2 class="font-bold text-xl text-gray-800 dark:text-gray-100 leading-tight uppercase">
                    ADMIN DASHBOARD
                </h2>
                <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">Manage albums you created and access admin tools.</p>
            </div>
            <a href="{{ route('albums.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
                {{ __('Add Album') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if($albums->isEmpty())
            <div class="overflow-hidden rounded-lg bg-white dark:bg-slate-900 shadow">
                <div class="p-6 text-slate-700 dark:text-slate-100">
                    <p class="text-lg font-semibold">No albums created yet.</p>
                    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Click the Add Album button to create your first album.</p>
                </div>
            </div>
            @else
            <div class="grid gap-6 xl:grid-cols-2">
                @foreach($albums as $album)
                <div class="overflow-hidden rounded-xl bg-white dark:bg-slate-900 shadow-sm border border-slate-200 dark:border-slate-700">
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
                                <p class="mt-1 text-sm font-medium text-slate-900 dark:text-slate-100">€{{ number_format($album->price, 2) }}</p>
                            </div>
                            <div class="rounded-xl bg-slate-50 dark:bg-slate-800 p-3">
                                <p class="text-xs uppercase tracking-wide text-slate-500 dark:text-slate-400">Stock</p>
                                <p class="mt-1 text-sm font-medium text-slate-900 dark:text-slate-100">{{ $album->stock }}</p>
                            </div>
                            <div class="rounded-xl bg-slate-50 dark:bg-slate-800 p-3">
                                <p class="text-xs uppercase tracking-wide text-slate-500 dark:text-slate-400">Released</p>
                                <p class="mt-1 text-sm font-medium text-slate-900 dark:text-slate-100">{{ optional($album->release_year)->format('Y') ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="{{ route('albums.show', $album) }}" class="inline-flex items-center px-3 py-2 rounded-lg bg-slate-100 text-slate-700 hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-100 dark:hover:bg-slate-700 text-sm font-medium">
                                {{ __('View') }}
                            </a>
                            <a href="{{ route('albums.edit', $album) }}" class="inline-flex items-center px-3 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 text-sm font-medium">
                                {{ __('Edit') }}
                            </a>
                            <form action="{{ route('albums.destroy', $album) }}" method="post" class="inline-block" onsubmit="return confirm('Delete this album?');">
                                @csrf
                                @method('delete')
                                <button type="submit" class="inline-flex items-center px-3 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 text-sm font-medium">
                                    {{ __('Delete') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</x-app-layout>