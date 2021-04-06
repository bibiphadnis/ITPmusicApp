@extends('layouts.email')

@section('content')
    <h1> Stats </h1>

    <p>
        Total number of artists: <?php echo $artists->count() ?>
        Total number of playlists: <?php echo $playlists->count() ?>
        Total time of all tracks: <?php echo $tracks ?>
    </p>
@endsection
