<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nieuwe genre</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    @include('partials.nav')

    <div class="max-w-3xl mx-auto py-8 px-4">
        <div class="mb-6">
            <h1 class="text-2xl font-semibold">Genre aanmaken</h1>
            <p class="text-sm text-gray-500">Vul de gegevens in en sla op.</p>
        </div>

        <div class="bg-white shadow-sm rounded-lg p-6">
            <form action="{{ route('genres.store') }}" method="post" class="space-y-4">
                @csrf
                
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Genre naam</label>
                    <input type="text" name="name" id="name" required class="mt-1 block w-full border rounded px-3 py-2">
                </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Beschrijving</label>
                        <textarea name="description" id="description" class="mt-1 block w-full border rounded px-3 py-2" rows="4"></textarea>
                    </div>
                </div>


                <div class="pt-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Genre aanmaken</button>
                    <a href="{{ route('genres.index') }}" class="ml-3 text-sm text-gray-600">Annuleren</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>