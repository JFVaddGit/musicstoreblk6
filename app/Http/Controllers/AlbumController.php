<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Album;
use App\Models\Artist;
use App\Models\Genre;

class AlbumController extends Controller
{
    public function index()
    {
        $genres = request()->query('genres', []);
        $genres = array_map('intval', (array) $genres);

        $albumsQuery = Album::query();

        if (!empty($genres)) {
            $albumsQuery->whereIn('genre_id', $genres);
        }

        $albums = $albumsQuery->get();
        return view('albums.index', compact('albums'));
    }




    public function create()
    {
        $artists = Artist::all();
        $genres = Genre::all();
        return view('albums.create', compact('artists', 'genres'));
    }




    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'artist_id' => 'required|integer|exists:artists,id',
            'release_year' => 'nullable|date',
            'label' => 'nullable|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'genre_id' => 'required|integer|exists:genres,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $album = new Album(); //NIEUW OBJECT AANMAKEN
        $album->title = $request->input('title');
        $album->artist_id = $request->input('artist_id');
        $album->release_year = $request->input('release_year');
        $album->label = $request->input('label');
        $album->price = $request->input('price');
        $album->stock = $request->input('stock');
        $album->genre_id = $request->input('genre_id');
        $album->user_id = Auth::id();

        if ($request->hasFile('image')) {
            $album->image = $request->file('image')->store('albums', 'public');
        }

        $album->save();
        return redirect()->route('albums.index')->with('success', 'Album succesvol aangemaakt.');
    }

    public function show(Album $album)
    {
        return view('albums.show', compact('album'));
    }




    public function edit($id)
    {
        $album = Album::findOrFail($id);
        $artists = Artist::all();
        $genres = Genre::all();

        return view('albums.edit', compact('album', 'artists', 'genres'));
    }




    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'artist_id' => 'required|integer',
            'release_year' => 'nullable|date',
            'label' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'genre_id' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $album = Album::findOrFail($id);
        $album->title = $request->input('title');
        $album->artist_id = $request->input('artist_id');
        $album->release_year = $request->input('release_year');
        $album->label = $request->input('label');
        $album->price = $request->input('price');
        $album->stock = $request->input('stock');
        $album->genre_id = $request->input('genre_id');

        if ($request->hasFile('image')) {
            if ($album->image && Storage::disk('public')->exists($album->image)) {
                Storage::disk('public')->delete($album->image);
            }
            $album->image = $request->file('image')->store('albums', 'public');
        }

        $album->save();
        return redirect()->route('albums.index')->with('success', 'Album succesvol bijgewerkt.');
    }




    public function destroy($id)
    {
        $album = Album::findOrFail($id);
        $album->delete();

        return redirect()->route('albums.index')->with('success', 'Album succesvol verwijderd.');
    }
}
