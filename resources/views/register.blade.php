<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registreren</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    @include('partials.nav')

    <div class="max-w-3xl mx-auto py-8 px-4">
        <div class="mb-6">
            <h1 class="text-2xl font-semibold">Registreren</h1>
            <p class="text-sm text-gray-500">Maak een account aan om het dashboard en beheerfuncties te gebruiken.</p>
        </div>

        <div class="bg-white shadow-sm rounded-lg p-6 max-w-md">
            <form action="{{ route('register') }}" method="post" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Naam</label>
                    <input type="text" name="name" id="name" required class="mt-1 block w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                    <input type="email" name="email" id="email" required class="mt-1 block w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Wachtwoord</label>
                    <input type="password" name="password" id="password" required class="mt-1 block w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Bevestig Wachtwoord</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required class="mt-1 block w-full border rounded px-3 py-2">
                </div>

                <div class="pt-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Registreer</button>
                    <a href="{{ route('dashboard') }}" class="ml-3 text-sm text-gray-600">Terug naar home</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>