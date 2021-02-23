@extends('layouts.main')

@section('title', 'Tracks')

@section('content')

    <div class="text-end mb-3">
        <a href="{{ route('tracks.new') }}"> New Track </a>
    </div>


    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Album</th>
                <th>Artist</th>
                <th>Media Type</th>
                <th>Genre</th>
                <th>Unit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tracks as $track)
                <tr>
                   <td>
                        {{ $track->name}}
                   </td>
                   <td>
                        {{ $track->album}}
                   </td>
                   <td>
                        {{ $track->artist}}
                   </td>
                   <td>
                        {{ $track->media_type}}
                   </td>
                   <td>
                        {{ $track->genre}}
                   </td>
                   <td>
                        {{ $track->price}}
                   </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection