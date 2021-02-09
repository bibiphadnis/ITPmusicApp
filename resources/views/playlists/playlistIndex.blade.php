@extends('layouts.main')

@section('title', 'Playlists')

@section('content')
    <table>
        <thead>
            <tr>
                <th>Playlist</th>
            </tr>
        </thead>
        <tbody>
            @foreach($playlists as $playlist)
                <tr>
                    <td>
                        <a href="{{route('playlists.playlistDetails', [ 'playlistId' => $playlist->id])}}">
                            {{$playlist->name}}
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection