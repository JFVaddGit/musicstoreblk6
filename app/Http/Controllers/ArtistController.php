<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;
use App\Models\Album;
use App\Models\Genre;

class ArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::all();
        return view('artists.index', compact('artists'));
    }




    public function create()
    {
        $artists = Artist::all();
        return view('artists.create', compact('artists'));
    }




    public function store(Request $request)
    {

        $artist = new Artist();//NIEUW OBJECT AANMAKEN
        $artist->name = $request->input('name');
        $artist->country = $request->input('country');
        $artist->bio = $request->input('bio');
        $artist->save();
        return redirect()->route('artists.index')->with('success', 'Artiest succesvol aangemaakt.');
    }   




    public function edit($id)
    {
        $artist = Artist::findOrFail($id);
        $artists = Artist::all();

        return view('artists.edit', compact('artist', 'artists'));
    }




    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ]);

        $artist = Artist::findOrFail($id);
        $artist->name = $request->input('name');
        $artist->country = $request->input('country');
        $artist->bio = $request->input('bio');
        $artist->save();
        return redirect()->route('artists.index')->with('success', 'Artiest succesvol bijgewerkt.');
    }



    public function destroy($id)
    {
        $artist = Artist::findOrFail($id);
        $artist->delete();

        return redirect()->route('artists.index')->with('success', 'Artiest succesvol verwijderd.');
    }
}
