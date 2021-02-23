@extends('layouts.main')

@section('title', 'Playlists')

@section('content')
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Playlist</th>
                <th>Actions</th>
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
                    <td>
                        <a href="{{ route('playlists.edit', [ 'playlistId' => $playlist->id ]) }}">
                        Rename
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection