@extends('layouts.main')

@section('title', 'Albums')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3 text-end">
    @if (Auth::check())
        <a href="{{ route('eloquentalbums.create') }}">New Album</a>
    @endif
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Album</th>
                <th>Artist</th>
                <th>Uploaded By</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($albums as $album)
                <tr>
                    <td>
                        {{$album->title}}
                    </td>
                    <td>
                        {{$album->artist->name}}
                    </td>
                    <td>
                        {{$album->user->name}}
                    </td>
                    @can ('update', $album)
                    <td>
                        <a href="{{ route('eloquentalbums.edit', [ 'id' => $album->id ]) }}">
                            Edit
                        </a>
                    </td>
                    @endcan
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection