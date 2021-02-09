@extends('layouts.main')

@section('title')
    Playlist: {{$playlist->name}}
@endsection

@section('content')
<a href="{{route('playlists.playlistIndex')}}" class="d-block mb-3">Back to All Playlists</a>
    <p>Total Tracks: {{$tracks->count()}}</p>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Track</th>
                <th>Album</th>
                <th>Artist</th>
                <th>Genre</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tracks as $track)
                <tr>
                    <td>{{$track->track}}</td>
                    <td>{{$track->album}}</td>
                    <td>{{$track->artist}}</td>
                    <td>{{$track->genre}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection