@extends('layouts.app')

@section('content')
<div class="container">
    <main>
        <h1>Artist Name: {{ $artist->name}}</h1>
        <p>Artist Bio:{{$artist->bio}}</p>
        @if ($artist->albums->count() > 0)
        <ul>
            @foreach ($artist->albums as $album)
                <li><a href="{{ route('albums.show', $album->id) }}">{{ $album->album_title }}</a></li>
            @endforeach
        </ul>
    @else
        <p>No albums available in this artist.</p>
    @endif
    </main>
</div>
@endsection
