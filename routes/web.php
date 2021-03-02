<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\TracksController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AlbumEloquentController;
use Illuminate\Support\Facades\Route;
use App\Models\Artist;
use App\Models\Track;
use App\Models\Genre;
use App\Models\Album;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/eloquent', function() {
    // // QUERYING
    // return view('eloquent.artists', [
    //     'artists' => Artist::orderBy('name')->get(),
    // ]);


    // return view('eloquent.tracks', [
    //     'tracks' => Track::all(),
    // ]);

    // return view('eloquent.tracks', [
    //     'tracks' => Track::where('unit_price', '>', 0.99)->orderBy('name')->get(),
    // ]);

    // return view('eloquent.artist', [
    //     'artist' => Artist::find(3),
    // ]);

    // CREATING
    // $genre = new Genre();
    // $genre->name = 'Hip Hop';
    // $genre->save();

    //DELETING
    // $genre = Genre::find(26);
    // $genre->delete();

    //UPDATING
    // $genre = Genre::where('name', '=', 'Alternative & Punk')->first();
    // $genre->name = 'Alternative and Punk';
    // $genre->save();

    // RELATIONSHIPS
    // return view('eloquent.has-many', [
    // 'artist' => Artist::find(50),
    // ]);

    // return view('eloquent.belongs-to', [
    //     'album' => Album::find(152),
    //     ]);

    //EAGER LOADING
    return view('eloquent.eager-loading', [
        // has n+1 problem
        // 'tracks' => Track::where('unit_price', '>', 0.99)
        // ->orderBy('name')
        // ->limit(5)
        // ->get(),

        // fixes  n+1 problem w/ eager loading
        'tracks' => Track::with(['album'])
        ->where('unit_price', '>', 0.99)
        ->orderBy('name')
        ->limit(5)
        ->get(),

    ]);


});


Route::get('/', function () {
    return view('welcome');
});


Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoice.index');
Route::get('/invoices/{id}', [InvoiceController::class, 'show'])->name('invoice.show');


Route::get('/playlists', [PlaylistController::class, 'playlistIndex'])->name('playlists.playlistIndex');
Route::get('/playlists/{playlistId}', [PlaylistController::class, 'playlistDetails'])->name('playlists.playlistDetails');
Route::get('/playlists/{playlistId}/edit', [PlaylistController::class, 'edit'])->name('playlists.edit');
Route::post('/playlists/{playlistId}', [PlaylistController::class, 'update'])->name('playlists.update');


Route::get('/tracks', [TracksController::class, 'index'])->name('tracks.index');
Route::get('/tracks/new', [TracksController::class, 'new'])->name('tracks.new');
Route::post('/tracks', [TracksController::class, 'store'])->name('tracks.store');

Route::get('/albums', [AlbumController::class, 'index'])->name('albums.index');
Route::get('/albums/create', [AlbumController::class, 'create'])->name('albums.create');
Route::post('/albums', [AlbumController::class, 'store'])->name('albums.store');
Route::get('/albums/{id}/edit', [AlbumController::class, 'edit'])->name('albums.edit');
 Route::post('/albums/{id}', [AlbumController::class, 'update'])->name('albums.update');

 Route::get('/eloquentalbums', [AlbumEloquentController::class, 'index'])->name('eloquentalbums.index');
Route::get('/eloquentalbums/create', [AlbumEloquentController::class, 'create'])->name('eloquentalbums.create');
Route::post('/eloquentalbums', [AlbumEloquentController::class, 'store'])->name('eloquentalbums.store');
Route::get('/eloqeuntalbums/{id}/edit', [AlbumEloquentController::class, 'edit'])->name('eloquentalbums.edit');
 Route::post('/eloquentalbums/{id}', [AlbumEloquentController::class, 'update'])->name('eloquentalbums.update');
