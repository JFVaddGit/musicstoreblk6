<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Albums' }}</title>
    <!-- Tailwind CDN (quick) - replace with your compiled CSS in production -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    @include('partials.nav')

    <div class="max-w-6xl mx-auto py-8 px-4">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-semibold">{{ $title ?? 'Album Overzicht' }}</h1>
                <p class="text-sm text-gray-500">Beheer je albums hier.</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('albums.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded shadow hover:bg-indigo-700">Nieuwe album</a>
                <a href="{{ route('tracks.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded shadow hover:bg-green-700">Nieuw nummer</a>
            </div>
        </div>

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
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titel</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Artiest</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Uitgebracht</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Genre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nummers</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Label</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prijs</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Voorraad</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acties</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($albums as $album)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $album->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $album->artist->name ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $album->release_year }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $album->genre->name ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">
                            @foreach($album->tracks as $track)
                                <div>{{ $track->title }}</div>
                            @endforeach
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $album->label }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">€{{ number_format(floatval($album->price), 2, ',', '.') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $album->stock }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('albums.edit', $album->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Bewerk</a>
                            <form action="{{ route('albums.destroy', $album->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Weet je zeker dat je dit album wilt verwijderen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Verwijder</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="p-8 text-center">
                <p class="text-gray-600 mb-4">Er zijn nog geen albums toegevoegd.</p>
                <a href="{{ route('albums.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Voeg een album toe</a>
            </div>
            @endif
        </div>
    </div>
</body>
</html>