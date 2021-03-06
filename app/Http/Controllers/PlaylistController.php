<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlaylistController extends Controller 
{

    public function playlistIndex() {
        $playlists = DB::table('playlists')
        ->get([
            'name',
            'id'
        ]);

        return view('playlists.playlistIndex', [
            'playlists' => $playlists
        ]);
    }

    public function playlistDetails($playlistId) {
        $playlist = DB::table('playlists')
            ->where('id', '=', $playlistId)
            ->first();


        $tracks = DB::table('playlist_track')
            ->where('playlist_id', '=', $playlistId)
            ->join('tracks', 'playlist_track.track_id', '=', 'tracks.id')
            ->join('albums', 'tracks.album_id', '=', 'albums.id')
            ->join('artists', 'albums.artist_id', '=', 'artists.id')
            ->join('genres', 'tracks.genre_id', '=', 'genres.id')
            ->get([
                'tracks.name AS track',
                'albums.title AS album',
                'artists.name AS artist',
                'genres.name AS genre'
            ]);


        return view('playlists.playlistDetails', [
            'playlist' => $playlist,
            'tracks' => $tracks
        ]);

    }

    public function edit($playlistId)
    {
        $playlist = DB::table('playlists')->where('id', '=', $playlistId)->first();

        
        return view('playlists.edit', [
            'playlist' => $playlist
        ]);

    }

    public function update($playlistId, Request $request)
    {
        $oldName = DB::table('playlists')
        ->where('id', '=', $playlistId)
        ->first();

        $request->validate([
            'name' => 'required|max:30|unique:playlists,name'
        ]);

        DB::table('playlists')->where('id', '=', $playlistId)->update([
            'name' => $request->input('name')
        ]);

        return redirect()
        ->route('playlists.playlistIndex')
        ->with('success', "{$oldName->name} was renamed to {$request->input('name')}");

    }



}


?>