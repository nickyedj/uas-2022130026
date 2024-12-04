@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $playlist->playlist_name }}</h1>
    <p>{{ $playlist->description }}</p>

    <form method="GET" action="{{ route('listsong', $playlist->id) }}">
        <input type="text" name="search" placeholder="Search songs..." value="{{ request('search') }}">
        <button type="submit">Search</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Song Title</th>
                <th>Album</th>
                <th>Artist</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($songs as $song)
                <tr>
                    <td>{{ $song->song_title }}</td>
                    <td>{{ $song->album->album_title ?? 'N/A' }}</td>
                    <td>{{ $song->album->artist->name ?? 'N/A' }}</td>
                    <td>
                        <form action="{{ route('playlist.removeSong', ['playlist' => $playlist->id, 'song' => $song->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $songs->links() }}
</div>
@endsection
