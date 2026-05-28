<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bestelling bewerken</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    @include('partials.nav')

    <div class="max-w-3xl mx-auto py-8 px-4">
        <div class="mb-6">
            <h1 class="text-2xl font-semibold">Bestelling bewerken</h1>
            <p class="text-sm text-gray-500">Pas de gegevens van de bestelling aan.</p>
        </div>

        <div class="bg-white shadow-sm rounded-lg p-6">
            <form action="{{ route('orders.update', $order->id) }}" method="post" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="order_date" class="block text-sm font-medium text-gray-700">Orderdatum *</label>
                    <input type="date" name="order_date" id="order_date" required value="{{ old('order_date', $order->order_date) }}" class="mt-1 block w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" required value="{{ old('status', $order->status) }}" class="mt-1 block w-full border rounded px-3 py-2">
                        <option value="pending">In afwachting</option>
                        <option value="processing">Verwerken</option>
                        <option value="completed">Voltooid</option>
                        <option value="cancelled">Geannuleerd</option>
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="album_id" class="block text-sm font-medium text-gray-700">Album</label>
                        <select name="album_id" id="album_id" class="mt-1 block w-full border rounded px-3 py-2">
                            <option value="">-- Kies een album --</option>
                            @foreach($albums as $album)
                                <option value="{{ $album->id }}" {{ $album->id == old('album_id', $order->album_id) ? 'selected' : '' }}>{{ $album->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="track_id" class="block text-sm font-medium text-gray-700">Track</label>
                        <select name="track_id" id="track_id" class="mt-1 block w-full border rounded px-3 py-2">
                            <option value="">-- Kies een track --</option>
                            @foreach($tracks as $track)
                                <option value="{{ $track->id }}" {{ $track->id == old('track_id', $order->track_id) ? 'selected' : '' }}>{{ $track->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label for="artist_id" class="block text-sm font-medium text-gray-700">Artiest *</label>
                    <select name="artist_id" id="artist_id" class="mt-1 block w-full border rounded px-3 py-2">
                        <option value="">-- Kies een artiest --</option>
                        @foreach($artists as $artist)
                            <option value="{{ $artist->id }}" {{ $artist->id == old('artist_id', $order->artist_id) ? 'selected' : '' }}>{{ $artist->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="total_price" class="block text-sm font-medium text-gray-700">Totaalbedrag *</label>
                    <input type="number" name="total_price" id="total_price" step="0.01" required value="{{ old('total_price', $order->total_price) }}" class="mt-1 block w-full border rounded px-3 py-2">
                </div>

                <div class="pt-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Opslaan</button>
                    <a href="{{ route('orders.index') }}" class="ml-3 text-sm text-gray-600">Annuleren</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
