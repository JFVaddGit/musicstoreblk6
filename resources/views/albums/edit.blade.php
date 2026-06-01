<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Album bewerken</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    @include('partials.nav')

    <div class="max-w-3xl mx-auto py-8 px-4">
        <div class="mb-6">
            <h1 class="text-2xl font-semibold">Album bewerken</h1>
            <p class="text-sm text-gray-500">Pas de albumgegevens aan en sla op.</p>
        </div>

        <div class="bg-white shadow-sm rounded-lg p-6">
            <form action="{{ route('albums.update', $album->id) }}" method="post" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Titel</label>
                        <input type="text" name="title" id="title" required value="{{ $album->title }}" class="mt-1 block w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label for="artist_id" class="block text-sm font-medium text-gray-700">Artiest</label>
                        <select name="artist_id" id="artist_id" class="mt-1 block w-full border rounded px-3 py-2">
                            <option value="">-- Kies een artiest --</option>
                            @foreach($artists as $artist)
                                <option value="{{ $artist->id }}" {{ $album->artist_id == $artist->id ? 'selected' : '' }}>{{ $artist->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @if($album->image)
                    <div class="mb-4">
                        <img src="{{ Storage::url($album->image) }}" alt="{{ $album->title }}" class="w-full h-64 object-cover rounded-lg shadow-sm" />
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="release_year" class="block text-sm font-medium text-gray-700">Uitgebracht op</label>
                        <input type="date" name="release_year" id="release_year" value="{{ $album->release_year }}" class="mt-1 block w-full border rounded px-3 py-2">
                    </div>


                    <div>
                        <label for="label" class="block text-sm font-medium text-gray-700">Label</label>
                        <input type="text" name="label" id="label" value="{{ $album->label }}" class="mt-1 block w-full border rounded px-3 py-2">
                    </div>
                </div>






                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Prijs</label>
                    <input type="text" name="price" id="price" required value="{{ $album->price }}" class="mt-1 block w-full border rounded px-3 py-2">
                </div>




                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-700">Voorraad</label>
                        <input type="number" name="stock" id="stock" value="{{ $album->stock }}" class="mt-1 block w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label for="genre_id" class="block text-sm font-medium text-gray-700">Genre</label>
                        <select name="genre_id" id="genre_id" class="mt-1 block w-full border rounded px-3 py-2">
                            <option value="">-- Kies een genre --</option>
                            @foreach($genres as $genre)
                                <option value="{{ $genre->id }}" {{ $album->genre_id == $genre->id ? 'selected' : '' }}>{{ $genre->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Album afbeelding</label>
                    <input type="file" name="image" id="image" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:text-sm file:rounded file:border-0 file:bg-indigo-50 file:px-3 file:py-2" />
                </div>

                <div class="pt-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Opslaan</button>
                    <a href="{{ route('albums.index') }}" class="ml-3 text-sm text-gray-600">Annuleren</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>