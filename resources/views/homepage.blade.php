<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welkom - Muziekwinkel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    <!-- Simple nav with only login/register -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ route('dashboard') }}" class="text-lg font-semibold text-gray-800">Muziekwinkel</a>
            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900">Inloggen</a>
                <a href="{{ route('register') }}" class="text-sm text-gray-600 hover:text-gray-900">Registreren</a>
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto py-8 px-4">
        <header class="mb-6">
            <h1 class="text-2xl font-semibold">Welkom, klant!</h1>
            <p class="text-sm text-gray-500">Blader door al onze producten. Meld je aan om te beheren.</p>
        </header>

        <!-- Genre and Artist filter dropdowns (door AI) -->
        @php
            $genresList = \App\Models\Genre::all();
            $artistsList = \App\Models\Artist::all();
            $selectedGenres = request()->query('genres', []);
            $selectedGenres = array_map('intval', (array) $selectedGenres);
            $selectedArtists = request()->query('artists', []);
            $selectedArtists = array_map('intval', (array) $selectedArtists);
        @endphp

        <div class="mb-6">
            <form method="get" class="flex flex-wrap items-center gap-3" id="filter-form">
                (Hulp van AI gebruikt voor filters, sorry)
                <label for="genre-filter" class="text-sm font-medium text-gray-700">Genre:</label>
                <select id="genre-filter" class="px-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-700 bg-white hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500" onchange="updateForm()">
                    <option value="">Alle genres</option>
                    @foreach($genresList as $genre)
                        <option value="{{ $genre->id }}" {{ in_array($genre->id, $selectedGenres) ? 'selected' : '' }}>{{ $genre->name }}</option>
                    @endforeach
                </select>

                <label for="artist-filter" class="text-sm font-medium text-gray-700">Artiest:</label>
                <select id="artist-filter" class="px-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-700 bg-white hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500" onchange="updateForm()">
                    <option value="">Alle artiesten</option>
                    @foreach($artistsList as $artist)
                        <option value="{{ $artist->id }}" {{ in_array($artist->id, $selectedArtists) ? 'selected' : '' }}>{{ $artist->name }}</option>
                    @endforeach
                </select>
                    <a href="{{ url('homepage') }}" class="px-3 py-2 text-sm text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded">Reset</a>
            </form>

            


            <script>
                function updateForm() {
                    const genreSelect = document.getElementById('genre-filter');
                    const artistSelect = document.getElementById('artist-filter');
                    
                    let url = '{{ url("homepage") }}?';
                    const params = [];
                    
                    if (genreSelect.value) {
                        params.push('genres[]=' + genreSelect.value);
                    }
                    
                    if (artistSelect.value) {
                        params.push('artists[]=' + artistSelect.value);
                    }
                    
                    if (params.length > 0) {
                        url += params.join('&');
                    }
                    
                    window.location.href = url;
                }
            </script>
        </div>




        @if($albums->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($albums as $album)
            <a href="{{ url('/albums/'.$album->id) }}" class="bg-white rounded-lg shadow-sm p-4 flex items-center gap-4 block">
                <div class="w-16 h-16 bg-gray-200 rounded overflow-hidden flex items-center justify-center">
                    <!-- placeholder image -->
                    <svg class="w-10 h-10 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7M8 7v8m8-8v8M3 7l9-4 9 4" />
                    </svg>
                </div>
                <div>
                    <div class="text-sm font-medium text-gray-900">{{ $album->title }}</div>
                    <div class="text-xs text-gray-500">{{ $album->artist->name ?? '-' }}</div>
                    <div class="text-xs text-gray-500">{{ $album->genre->name ?? '-' }}</div>
                    <div class="text-sm text-gray-700 font-semibold mt-2">€{{ isset($album->price) ? number_format((float)$album->price, 2, ',', '.') : '-' }}</div>
                </div>
            </a>
            @endforeach
        </div>
        @else
        <div class="bg-white p-6 rounded-lg shadow-sm text-center text-gray-600">
            Er zijn momenteel geen albums beschikbaar.
        </div>
        @endif
    </main>
</body>
</html>
