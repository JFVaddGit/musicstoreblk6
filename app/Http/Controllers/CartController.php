<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\CartItem;

class CartController extends Controller
{
    // INDEX
    public function index()
    {
        $cartItems = CartItem::with('album')
            ->where('user_id', auth()->id())
            ->get();

        return view('cart.index', compact('cartItems'));
    }


    // STORE
    public function store(Request $request)
    {
        $album = Album::findOrFail($request->album_id);

        $existing = CartItem::where('user_id', auth()->id())
            ->where('album_id', $album->id)
            ->first();

        if ($existing) {
            $existing->increment('quantity');
        } else {
            CartItem::create([
                'user_id' => auth()->id(),
                'album_id' => $album->id,
                'quantity' => 1,
            ]);
        }

        return back()->with('success', 'Album added to cart.');
    }


    // DESTROY
    public function destroy(CartItem $cartItem)
    {
        abort_if(
            $cartItem->user_id !== auth()->id(),
            403
        );

        $cartItem->delete();

        return back();
    }




}
