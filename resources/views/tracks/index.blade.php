<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h1 class="font-bold text-xl text-gray-800 dark:text-gray-100 uppercase">Tracks</h1>
                <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">Beheer je nummers hier.</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('albums.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded shadow hover:bg-green-700">Nieuw album</a>
                <a href="{{ route('tracks.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded shadow hover:bg-indigo-700">Nieuw nummer</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @if(isset($tracks) && $tracks->count())
            <div class="overflow-hidden rounded-3xl bg-white shadow border border-slate-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titel</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Album</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Artiest</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Genre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Track #</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duur</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acties</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($tracks as $track)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $track->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $track->album->title ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $track->artist->name ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $track->genre->name ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $track->track_number ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $track->duration ? floor($track->duration / 60) . ':' . str_pad($track->duration % 60, 2, '0', STR_PAD_LEFT) : '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('tracks.edit', $track->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Bewerk</a>
                                <form action="{{ route('tracks.destroy', $track->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Weet je zeker dat je dit nummer wilt verwijderen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Verwijder</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="p-8 bg-white rounded-3xl shadow border border-slate-200 text-center">
                <p class="text-gray-600 mb-4">Er zijn nog geen nummers toegevoegd.</p>
                <a href="{{ route('tracks.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Voeg een nummer toe</a>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>