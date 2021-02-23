<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\TracksController;
use Illuminate\Support\Facades\Route;

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

