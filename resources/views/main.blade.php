@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/music-player.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="container">
        <form action="{{ url()->current() }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search song by title/album/artist..."
                    value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </form>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h1>Songs List</h1>
        <main>
            <div>
                @auth
                    @if (Auth::user()->is_admin)
                        <a href="{{ route('songs.create') }}" class="btn btn-primary">Add Song</a>
                    @endif
                @endauth
            </div>

            <table class="table table-bordered mt-3 text-center">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Song Title</th>
                        <th>Album</th>
                        <th>Artist</th>
                        <th>Genre</th>
                        <th style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Description</th>
                        @auth
                            @if (Auth::user()->is_admin)
                                <th>Actions</th>
                            @endif
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @foreach ($songs as $song)
                        <tr data-song-id="{{ $song->id }}" onclick="playSong({{ $song->id }})">
                            <td>{{ $song->id }}</td>
                            <td class="song-title">{{ $song->song_title }}</td>
                            <td>{{ $song->album ? $song->album->album_title : 'N/A' }}</td>
                            <td class="song-artist">{{ $song->artist ? $song->artist->name : 'N/A' }}</td>
                            <td>{{ $song->genre }}</td>
                            <td>{{ $song->description }}</td>
                            <input type="hidden" class="audio-url" value="{{ Storage::url($song->audio) }}">
                            <!-- Actions Column -->
                            @auth
                                @if (Auth::user()->is_admin)
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Actions">
                                            <a href="{{ route('songs.show', $song->id) }}" class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('songs.edit', $song->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('songs.destroy', $song->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this song?')">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                            @endauth
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $songs->links() }}
        </main>
    </div>

    <!-- Sticky Audio Player -->
    <div class="music-player">
        <div class="song-info">
            <span id="songTitle">Song Title</span> - <span id="songArtist">Artist</span>
        </div>
        <audio id="audioPlayer" controls>
            <source id="audioSource" src="" type="audio/mp3">
        </audio>
    </div>

    <script>
        function playSong(songId) {
            console.log('Song played with ID:', songId); // Pastikan fungsi ini dipanggil

            // Dapatkan data lagu dari server atau dari elemen HTML yang sudah ada
            const songRow = document.querySelector(`tr[data-song-id="${songId}"]`);
            const songTitle = songRow.querySelector('.song-title').innerText;
            const songArtist = songRow.querySelector('.song-artist').innerText;
            const audioUrl = songRow.querySelector('.audio-url').value;

            // Update informasi player
            document.getElementById('songTitle').innerText = songTitle;
            document.getElementById('songArtist').innerText = songArtist;

            // Update sumber audio dan mulai putar
            const audioPlayer = document.getElementById('audioPlayer');
            const audioSource = document.getElementById('audioSource');
            audioSource.src = audioUrl;
            audioPlayer.load();
            audioPlayer.play();
        }
    </script>
@endsection
