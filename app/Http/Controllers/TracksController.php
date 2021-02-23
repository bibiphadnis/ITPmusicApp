<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TracksController extends Controller
{
    public function index()
    {
        $tracks = DB::table('tracks') 
        ->join('albums', 'album_id', '=', 'albums.id')
        ->join('media_types', 'media_type_id', '=', 'media_types.id')
        ->join('genres', 'genre_id', '=', 'genres.id')
        ->get([
            'tracks.name',
            'tracks.composer AS artist',
            'tracks.unit_price AS price',
            'albums.title AS album',
            'genres.name AS genre',
            'media_types.name AS media_type'
        ]);


        return view('tracks.index', [
            'tracks' => $tracks
        ]);
    }


    public function new() 
    {

        $albums = DB::table('albums')->orderBy('title')->get();
        $media_types = DB::table('media_types')->orderBy('name')->get();
        $genres = DB::table('genres')->orderBy('name')->get();

        return view('tracks.new', [
            'albums' => $albums,
            'media_types' => $media_types,
            'genres' => $genres
        ]);
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'album' => 'required|exists:albums,id',
            'media_type' => 'required|exists:media_types,id',
            'genre' => 'required|exists:genres,id',
            'unit_price' => 'required|numeric'
        ]);

        DB::table('tracks')->insert([
            'name' => $request->input('name'),
            'album_id' => $request->input('album'),
            'genre_id' => $request->input('genre'),
            'media_type_id'=>$request->input('media_type'),
            'unit_price' => $request->input('unit_price')
        ]);

        return redirect()
        ->route('tracks.index')
        ->with('success', "The track {$request->input('name')} was successfully created");
    }

}
