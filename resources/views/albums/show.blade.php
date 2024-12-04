@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Album Detail: {{ $album->album_title }}</h1>

    <div class="row align-items-start">
        <div class="col-md-3" style="padding-right: 0;">
            @if ($album->image)
                <img src="{{ Storage::url($album->image) }}" class="img-fluid" style="width: 100%; max-width: 250px;">
            @endif
        </div>

        <div class="col-md-8" style="padding-left: 0px;">
            <p><strong>Artist:</strong> <a href="{{ route('artists.show', $album->artist->id) }}">{{ $album->artist->name }}</a></p>
            <p><strong>Release Date:</strong> {{ $album->release_date }}</p>

            <h3>Songs list:</h3>
            @if ($album->songs->count() > 0)
                <ul>
                    @foreach ($album->songs as $song)
                        <li><a href="{{ route('songs.show', $song->id) }}">{{ $song->song_title }}</a></li>
                    @endforeach
                </ul>
            @else
                <p>No songs available in this album.</p>
            @endif
        </div>
    </div>
</div>
@endsection
