<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Pagina</title>
    <link rel="stylesheet" href="/css/dashboard.css">
    <script src="/js/dashboard.js" defer></script>
</head>
<body>
    @include('partials.nav')
    <header class="px-4 py-6 text-center">
        <h1 class="text-2xl font-semibold">Je bent uitgelogd</h1>
        <a href="{{ route('login') }}" class="mt-4 inline-block px-4 py-2 bg-indigo-600 text-white rounded">Login opnieuw</a>
    </header>
</body>
</html>