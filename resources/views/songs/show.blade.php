{{-- resources/views/songs/show.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $song->song_title }}</h1>

        <p><strong>Artist:</strong> <a href="{{ route('artists.show', $song->artist->id) }}">{{ $song->artist ? $song->artist->name : 'Unknown Artist' }}</a></p>
        <p><strong>Album:</strong> <a href="{{ route('albums.show', $song->album->id) }}">{{ $song->album ? $song->album->album_title : 'Unknown Album' }}</a></a></p>
        <p><strong>Genre:</strong> {{ $song->genre }}</p>
        <p><strong>Description:</strong> {{ $song->description }}</p>

        @if ($song->audio)
            <audio src="{{ Storage::url($song->audio) }}"preload="auto" controls></audio>
        @endif
    </div>
@endsection
