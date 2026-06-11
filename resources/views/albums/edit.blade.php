<x-app-layout>
    @php
    $genresList = \App\Models\Genre::all();
    $selectedGenres = request()->query('genres', []);
    $selectedGenres = array_map('intval', (array) $selectedGenres);
    $search = request()->query('search', '');
    @endphp

    <x-slot name="header">
        <div class="relative flex items-center">
            <a href="{{ route('albums.index') }}"
            class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                &larr; Back to Albums
            </a>

            <h2 class="absolute left-1/2 -translate-x-1/2 font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
                {{ $album->title }}
            </h2>
        </div>
    </x-slot>

    <body class="bg-gray-50 text-gray-800">
        <div class="max-w-3xl mx-auto py-8 px-4">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <form action="{{ route('albums.update', $album->id) }}" method="post" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title" required value="{{ $album->title }}" class="mt-1 block w-full border rounded px-3 py-2">
                        </div>

                        <div>
                            <label for="artist_id" class="block text-sm font-medium text-gray-700">Artist</label>
                            <select name="artist_id" id="artist_id" class="mt-1 block w-full border rounded px-3 py-2">
                                <option value="">-- Choose an artist --</option>
                                @foreach($artists as $artist)
                                    <option value="{{ $artist->id }}" {{ $album->artist_id == $artist->id ? 'selected' : '' }}>{{ $artist->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="release_year" class="block text-sm font-medium text-gray-700">Release Year</label>
                            <input type="date" name="release_year" id="release_year" value="{{ $album->release_year }}" class="mt-1 block w-full border rounded px-3 py-2">
                        </div>


                        <div>
                            <label for="label" class="block text-sm font-medium text-gray-700">Label</label>
                            <input type="text" name="label" id="label" value="{{ $album->label }}" class="mt-1 block w-full border rounded px-3 py-2">
                        </div>
                    </div>






                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                        <input type="text" name="price" id="price" required value="{{ $album->price }}" class="mt-1 block w-full border rounded px-3 py-2">
                    </div>




                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                            <input type="number" name="stock" id="stock" value="{{ $album->stock }}" class="mt-1 block w-full border rounded px-3 py-2">
                        </div>

                        <div>
                            <label for="genre_id" class="block text-sm font-medium text-gray-700">Genre</label>
                            <select name="genre_id" id="genre_id" class="mt-1 block w-full border rounded px-3 py-2">
                                <option value="">-- Choose a genre --</option>
                                @foreach($genres as $genre)
                                    <option value="{{ $genre->id }}" {{ $album->genre_id == $genre->id ? 'selected' : '' }}>{{ $genre->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700">Album thumbnail</label>
                        <input type="file" name="image" id="image" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:text-sm file:rounded file:border-0 file:bg-indigo-50 file:px-3 file:py-2" />
                    </div>

                    @if($album->image)
                        <div class="mb-4">
                            <img src="{{ Storage::url($album->image) }}" alt="{{ $album->title }}" class="w-full h-64 object-cover rounded-lg shadow-sm" />
                        </div>
                    @endif

                    <div class="pt-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Opslaan</button>
                        <a href="{{ route('albums.show', $album) }}" class="ml-3 text-sm text-gray-600">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</x-app-layout>