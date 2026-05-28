<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Album;
use App\Models\Artist;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return view('genres.index', compact('genres'));
    }




    public function create()
    {
        $albums = Album::all();
        $artists = Artist::all();
        return view('genres.create', compact('albums', 'artists'));
    }




    public function store(Request $request)
    {
    
        $genre = new Genre();//NIEUW OBJECT AANMAKEN
        $genre->name = $request->input('name');
        $genre->description = $request->input('description');
        $genre->save();
        return redirect()->route('genres.index')->with('success', 'Genre succesvol aangemaakt.');
    }   




    public function edit($id)
    {
        $genre = Genre::findOrFail($id);
        $artists = Artist::all();
        $genres = Genre::all();

        return view('genres.edit', compact('genre', 'artists', 'genres'));
    }




    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $genre = Genre::findOrFail($id);
        $genre->name = $request->input('name');
        $genre->description = $request->input('description');
        $genre->save();
        return redirect()->route('genres.index')->with('success', 'Genre succesvol bijgewerkt.');
    }




    public function destroy($id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();

        return redirect()->route('genres.index')->with('success', 'Genre succesvol verwijderd.');
    }
}
