<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Genres' }}</title>
    <!-- Tailwind CDN (quick) - replace with your compiled CSS in production -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    @include('partials.nav')

    <div class="max-w-6xl mx-auto py-8 px-4">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-semibold">{{ $title ?? 'Genre overzicht' }}</h1>
                <p class="text-sm text-gray-500">Beheer genres hier.</p>
            </div>
            <div>
                <a href="{{ route('genres.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded shadow hover:bg-indigo-700">Nieuwe genre</a>
            </div>
        </div>

        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            @if(isset($genres) && $genres->count())
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Naam</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Beschrijving</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acties</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($genres as $genre)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $genre->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $genre->description ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('genres.edit', $genre->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Bewerk</a>
                            <form action="{{ route('genres.destroy', $genre->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Weet je zeker dat je deze genre wilt verwijderen?');">
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
                <p class="text-gray-600 mb-4">Er zijn nog geen genres toegevoegd.</p>
                <a href="{{ route('genres.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Voeg een genre toe</a>
            </div>
            @endif
        </div>
    </div>
</body>
</html>