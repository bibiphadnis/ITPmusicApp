<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = DB::table('albums')
            ->join('artists', 'albums.artist_id', '=', 'artists.id')
            ->orderBy('artist')
            ->orderBy('title')
            ->get([
                'albums.id AS id',
                'albums.title',
                'artists.name AS artist',
            ]);

        return view('albums.index', [
            'albums' => $albums,
        ]);
    }

    public function create()
    {
        $artists = DB::table('artists')->orderBy('name')->get();

        return view('albums.create', [
            'artists' => $artists,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:20',
            'artist' => 'required|exists:artists,id',
        ]);

        DB::table('albums')->insert([
            'title' => $request->input('title'),
            'artist_id' => $request->input('artist'),
        ]);

        $artist = DB::table('artists')
            ->where('id', '=', $request->input('artist'))
            ->first();

        return redirect()
            ->route('albums.index')
            ->with('success', "Successfully created {$artist->name} - {$request->input('title')}");
    }

    public function edit($id)
    {
        $album = DB::table('albums')->where('id', '=', $id)->first();
        $artists = DB::table('artists')->orderBy('name')->get();

        return view('albums.edit', [
            'album' => $album,
            'artists' => $artists,
        ]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'title' => 'required|max:20',
            'artist' => 'required|exists:artists,id',
        ]);

        DB::table('albums')->where('id', '=', $id)->update([
            'title' => $request->input('title'),
            'artist_id' => $request->input('artist'),
        ]);

        $artist = DB::table('artists')
            ->where('id', '=', $request->input('artist'))
            ->first();

        return redirect()
            ->route('albums.edit', [ 'id' => $id ])
            ->with('success', "Successfully updated {$artist->name} - {$request->input('title')}");
    }
}