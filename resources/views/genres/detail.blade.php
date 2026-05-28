<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Index</title>
    <link rel="stylesheet" href="/css/dashboard.css">
</head>
<body>
    @include('partials.nav')
    <header class="px-4 py-6">
        <h1 class="text-2xl font-semibold">Producten Overzicht</h1>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th>Naam</th>
                    <th>Prijs</th>
                    <th>Beschrijving</th>
                    <th>Voorraad</th>
                    <th>Categorie</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->category->name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</body>
</html>