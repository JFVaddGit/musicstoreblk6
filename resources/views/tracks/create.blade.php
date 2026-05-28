<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Track toevoegen</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    @include('partials.nav')

    <div class="max-w-3xl mx-auto py-8 px-4">
        <div class="mb-6">
            <h1 class="text-2xl font-semibold">Track toevoegen</h1>
            <p class="text-sm text-gray-500">Voeg een nieuw nummer toe aan een album.</p>
        </div>

        <div class="bg-white shadow-sm rounded-lg p-6">
            <form action="{{ route('tracks.store') }}" method="post" class="space-y-4">
                @csrf

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Titel *</label>
                    <input type="text" name="title" id="title" required class="mt-1 block w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label for="album_id" class="block text-sm font-medium text-gray-700">Album *</label>
                    <select name="album_id" id="album_id" required class="mt-1 block w-full border rounded px-3 py-2">
                        <option value="">-- Kies een album --</option>
                        @foreach($albums as $album)
                            <option value="{{ $album->id }}">{{ $album->title }} - {{ $album->artist->name ?? '-' }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="track_number" class="block text-sm font-medium text-gray-700">Track nummer</label>
                        <input type="number" name="track_number" id="track_number" class="mt-1 block w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label for="duration" class="block text-sm font-medium text-gray-700">Duur (seconden)</label>
                        <input type="number" name="duration" id="duration" class="mt-1 block w-full border rounded px-3 py-2">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="genre_id" class="block text-sm font-medium text-gray-700">Genre</label>
                        <select name="genre_id" id="genre_id" class="mt-1 block w-full border rounded px-3 py-2">
                            <option value="">-- Kies een genre --</option>
                            @foreach($genres as $genre)
                                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="artist_id" class="block text-sm font-medium text-gray-700">Artiest</label>
                        <select name="artist_id" id="artist_id" class="mt-1 block w-full border rounded px-3 py-2">
                            <option value="">-- Kies een artiest --</option>
                            @foreach($artists as $artist)
                                <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Toevoegen</button>
                    <a href="{{ route('tracks.index') }}" class="ml-3 text-sm text-gray-600">Annuleren</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
