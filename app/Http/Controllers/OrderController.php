<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Album;
use App\Models\Track;
use App\Models\Artist;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $albums = Album::all();
        $tracks = Track::all();
        $artists = Artist::all();
        return view('orders.create', compact('albums', 'tracks', 'artists'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_date' => 'required|date',
            'status' => 'required|string',
            'total_price' => 'required|numeric',
            'artist_id' => 'required|integer',
            'album_id' => 'nullable|integer',
            'track_id' => 'nullable|integer',
        ]);

        $order = new Order();
        $order->order_date = $request->input('order_date');
        $order->status = $request->input('status');
        $order->total_price = $request->input('total_price');
        $order->album_id = $request->input('album_id');
        $order->track_id = $request->input('track_id');
        $order->artist_id = $request->input('artist_id');
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Bestelling succesvol aangemaakt.');
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $albums = Album::all();
        $tracks = Track::all();
        $artists = Artist::all();

        return view('orders.edit', compact('order', 'albums', 'tracks', 'artists'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'order_date' => 'required|date',
            'status' => 'required|string',
            'total_price' => 'required|numeric',
            'album_id' => 'nullable|integer',
            'track_id' => 'nullable|integer',
            'artist_id' => 'nullable|integer',
        ]);

        $order = Order::findOrFail($id);
        $order->order_date = $request->input('order_date');
        $order->status = $request->input('status');
        $order->total_price = $request->input('total_price');
        $order->album_id = $request->input('album_id');
        $order->track_id = $request->input('track_id');
        $order->artist_id = $request->input('artist_id');
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Bestelling succesvol bijgewerkt.');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Bestelling succesvol verwijderd.');
    }
}
