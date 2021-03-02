<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Album;
use App\Models\Artist;

class AlbumEloquentController extends Controller
{
    public function index()
    {

        $albums = Album::with(['artist'])->get();

        return view('eloquentalbums.index', [
            'albums' => $albums,
        ]);
    }

    public function create()
    {
        $artists = Artist::orderBy('name')->get();

        return view('eloquentalbums.create', [
            'artists' => $artists,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:20',
            'artist' => 'required|exists:artists,id',
        ]);

        $album = new Album();
        $album->title = $request->input('title');
        $album->artist_id = $request->input('artist');
        $album->save(); 


        $artist = Artist::find($request->input('artist'));

        return redirect()
            ->route('eloquentalbums.index')
            ->with('success', "Successfully created {$artist->name} - {$request->input('title')}");
    }

    public function edit($id)
    {


        $album = Album::find($id);
        
        $artists = Artist::orderBy('name')->get();

        return view('eloquentalbums.edit', [
            'album' => $album,
            'artists' => $artists,
        ]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'title' => 'required|max:40',
            'artist' => 'required|exists:artists,id',
        ]);

        $albums = Album::where('id', '=', $id)->first();
        $albums->title = $request->input('title');
        $albums->artist_id = $request->input('artist');
        $albums->save();

        $artist = Artist::find($request->input('artist'));

        return redirect()
            ->route('eloquentalbums.edit', [ 'id' => $id ])
            ->with('success', "Successfully updated {$artist->name} - {$request->input('title')}");
    }
}