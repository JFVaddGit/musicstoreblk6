<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Artiest bewerken</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    @include('partials.nav')

    <div class="max-w-3xl mx-auto py-8 px-4">
        <div class="mb-6">
            <h1 class="text-2xl font-semibold">Artiest bewerken</h1>
            <p class="text-sm text-gray-500">Pas de artiestegegevens aan en sla op.</p>
        </div>

        <div class="bg-white shadow-sm rounded-lg p-6">
            <form action="{{ route('artists.update', $artist->id) }}" method="post" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Artiest naam</label>
                    <input type="text" name="name" id="name" required value="{{ $artist->name }}" class="mt-1 block w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label for="country" class="block text-sm font-medium text-gray-700">Land</label>
                    <input type="text" name="country" id="country" required value="{{ $artist->country }}" class="mt-1 block w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label for="bio" class="block text-sm font-medium text-gray-700">Biografie</label>
                    <textarea name="bio" id="bio" class="mt-1 block w-full border rounded px-3 py-2" rows="4">{{ $artist->bio }}</textarea>
                </div>

                <div class="pt-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Opslaan</button>
                    <a href="{{ route('artists.index') }}" class="ml-3 text-sm text-gray-600">Annuleren</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>