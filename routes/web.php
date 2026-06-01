<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user && method_exists($user, 'isAdmin') && $user->isAdmin()) {
        return redirect()->route('dashboard.admin');
    }
    if ($user && method_exists($user, 'isEmployee') && $user->isEmployee()) {
        return redirect()->route('dashboard.employee');
    }

    return view('dashboard.user');
})->middleware(['auth', 'verified'])->name('dashboard');

// Role-specific dashboard views
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard/admin', function () {
        $albums = \App\Models\Album::where('user_id', auth()->id())
            ->with(['artist', 'genre'])
            ->orderByDesc('created_at')
            ->get();

        return view('dashboard.admin', compact('albums'));
    })->name('dashboard.admin');
    Route::view('/dashboard/employee', 'dashboard.employee')->name('dashboard.employee');
    // Backwards-compatible names used in views
    Route::view('/dashboard/freelancer', 'dashboard.employee')->name('dashboard.freelancer');
    Route::view('/dashboard/client', 'dashboard.user')->name('dashboard.client');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// TRACKS
Route::middleware('auth')->group(function () {
    Route::get('/albums', [\App\Http\Controllers\AlbumController::class, 'index'])->name('albums.index');
    Route::get('/albums/create', [\App\Http\Controllers\AlbumController::class, 'create'])->name('albums.create');
    Route::post('/albums', [\App\Http\Controllers\AlbumController::class, 'store'])->name('albums.store');
    Route::get('/albums/{album}', [\App\Http\Controllers\AlbumController::class, 'show'])->name('albums.show');
    Route::get('/albums/{album}/edit', [\App\Http\Controllers\AlbumController::class, 'edit'])->name('albums.edit');
    Route::put('/albums/{album}', [\App\Http\Controllers\AlbumController::class, 'update'])->name('albums.update');
    Route::delete('/albums/{album}', [\App\Http\Controllers\AlbumController::class, 'destroy'])->name('albums.destroy');
});


// TRACKS
Route::middleware('auth')->group(function () {
    Route::get('/tracks', [\App\Http\Controllers\TrackController::class, 'index'])->name('tracks.index');
    Route::get('/tracks/create', [\App\Http\Controllers\TrackController::class, 'create'])->name('tracks.create');
    Route::post('/tracks', [\App\Http\Controllers\TrackController::class, 'store'])->name('tracks.store');
    Route::get('/tracks/{track}', [\App\Http\Controllers\TrackController::class, 'show'])->name('tracks.show');
    Route::get('/tracks/{track}/edit', [\App\Http\Controllers\TrackController::class, 'edit'])->name('tracks.edit');
    Route::put('/tracks/{track}', [\App\Http\Controllers\TrackController::class, 'update'])->name('tracks.update');
    Route::delete('/tracks/{track}', [\App\Http\Controllers\TrackController::class, 'destroy'])->name('tracks.destroy');
});


// GENRES
Route::middleware('auth')->group(function () {
    Route::get('/genres', [\App\Http\Controllers\GenreController::class, 'index'])->name('genres.index');
    Route::get('/genres/create', [\App\Http\Controllers\GenreController::class, 'create'])->name('genres.create');
    Route::post('/genres', [\App\Http\Controllers\GenreController::class, 'store'])->name('genres.store');
    Route::get('/genres/{genre}', [\App\Http\Controllers\GenreController::class, 'show'])->name('genres.show');
    Route::get('/genres/{genre}/edit', [\App\Http\Controllers\GenreController::class, 'edit'])->name('genres.edit');
    Route::put('/genres/{genre}', [\App\Http\Controllers\GenreController::class, 'update'])->name('genres.update');
    Route::delete('/genres/{genre}', [\App\Http\Controllers\GenreController::class, 'destroy'])->name('genres.destroy');
});


// ARTISTS
Route::middleware('auth')->group(function () {
    Route::get('/artists', [\App\Http\Controllers\ArtistController::class, 'index'])->name('artists.index');
    Route::get('/artists/create', [\App\Http\Controllers\ArtistController::class, 'create'])->name('artists.create');
    Route::post('/artists', [\App\Http\Controllers\ArtistController::class, 'store'])->name('artists.store');
    Route::get('/artists/{artist}', [\App\Http\Controllers\ArtistController::class, 'show'])->name('artists.show');
    Route::get('/artists/{artist}/edit', [\App\Http\Controllers\ArtistController::class, 'edit'])->name('artists.edit');
    Route::put('/artists/{artist}', [\App\Http\Controllers\ArtistController::class, 'update'])->name('artists.update');
    Route::delete('/artists/{artist}', [\App\Http\Controllers\ArtistController::class, 'destroy'])->name('artists.destroy');
});

// ORDERS
Route::middleware('auth')->group(function () {
    Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [\App\Http\Controllers\OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [\App\Http\Controllers\OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [\App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{order}/edit', [\App\Http\Controllers\OrderController::class, 'edit'])->name('orders.edit');
    Route::put('/orders/{order}', [\App\Http\Controllers\OrderController::class, 'update'])->name('orders.update');
    Route::delete('/orders/{order}', [\App\Http\Controllers\OrderController::class, 'destroy'])->name('orders.destroy');
});




require __DIR__ . '/auth.php';
