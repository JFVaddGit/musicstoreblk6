<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Track;
use App\Models\Album;
use App\Models\Genre;
use App\Models\Artist;

class TrackController extends Controller
{
    public function index()
    {
        $tracks = Track::with('album', 'artist', 'genre')->get();
        return view('tracks.index', compact('tracks'));
    }

    public function create()
    {
        $albums = Album::all();
        $genres = Genre::all();
        $artists = Artist::all();
        return view('tracks.create', compact('albums', 'genres', 'artists'));
    }

    public function store(Request $request)
    {
        $track = new Track();
        $track->title = $request->input('title');
        $track->album_id = $request->input('album_id');
        $track->duration = $request->input('duration');
        $track->track_number = $request->input('track_number');
        $track->genre_id = $request->input('genre_id');
        $track->artist_id = $request->input('artist_id');
        $track->save();
        
        return redirect()->route('albums.index')->with('success', 'Track succesvol toegevoegd.');
    }

    public function edit($id)
    {
        $track = Track::findOrFail($id);
        $albums = Album::all();
        $genres = Genre::all();
        $artists = Artist::all();
        return view('tracks.edit', compact('track', 'albums', 'genres', 'artists'));
    }

    public function update(Request $request, $id)
    {
        $track = Track::findOrFail($id);
        $track->title = $request->input('title');
        $track->album_id = $request->input('album_id');
        $track->duration = $request->input('duration');
        $track->track_number = $request->input('track_number');
        $track->genre_id = $request->input('genre_id');
        $track->artist_id = $request->input('artist_id');
        $track->save();
        
        return redirect()->route('albums.index')->with('success', 'Track succesvol bijgewerkt.');
    }

    public function destroy($id)
    {
        $track = Track::findOrFail($id);
        $track->delete();
        return redirect()->route('albums.index')->with('success', 'Track succesvol verwijderd.');
    }
}
