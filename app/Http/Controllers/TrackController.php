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
        $genres = array_map(
            'intval',
            (array) request()->query('genres', [])
        );

        $search = request()->query('search', '');

        $tracksQuery = Track::query();

        if (!empty($search)) {
            $tracksQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhereHas('artist', function ($artistQuery) use ($search) {
                        $artistQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if (!empty($genres)) {
            $tracksQuery->whereIn('genre_id', $genres);
        }

        $tracks = $tracksQuery->get();

        return view('tracks.index', compact('tracks', 'search'));
    }






    public function create(Request $request)
    {
        $selectedAlbum = null;
        if ($request->query('album_id')) {
            $selectedAlbum = Album::find($request->query('album_id'));
        }

        if (! $selectedAlbum) {
            return redirect()->route('albums.index');
        }

        $genres = Genre::all();
        $artists = Artist::all();
        $existingTrackNumber = $selectedAlbum->tracks()->max('track_number');
        $trackCount = $selectedAlbum->tracks()->count();
        $nextTrackNumber = max($existingTrackNumber ?? 0, $trackCount) + 1;

        return view('tracks.create', compact('genres', 'artists', 'selectedAlbum', 'nextTrackNumber'));
    }

    public function store(Request $request)
    {
        $track = new Track();
        $track->title = $request->input('title');
        $track->album_id = $request->input('album_id');
        $track->duration = $request->input('duration');

        $trackNumber = $request->input('track_number');
        if (empty($trackNumber)) {
            $existingTrackNumber = Track::where('album_id', $request->input('album_id'))->max('track_number');
            $trackCount = Track::where('album_id', $request->input('album_id'))->count();
            $trackNumber = max($existingTrackNumber ?? 0, $trackCount) + 1;
        }
        $track->track_number = $trackNumber;

        $track->genre_id = $request->input('genre_id');
        $track->artist_id = $request->input('artist_id');
        $track->save();

        return redirect()->route('albums.show', $track->album_id)->with('success', 'Track succesvol toegevoegd.');
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

        return redirect()->route('albums.show', $track->album_id)->with('success', 'Track succesvol bijgewerkt.');
    }

    public function destroy($id)
    {
        $track = Track::findOrFail($id);
        $track->delete();
        return redirect()->route('albums.show', $track->album_id)->with('success', 'Track succesvol verwijderd.');
    }
}
