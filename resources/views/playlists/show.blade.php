@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/music-player.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="container">
        <h1>Playlist: {{ $playlist->playlist_name }}</h1>
        <p><strong>Description:</strong> {{ $playlist->description }}</p>

        <!-- Search form -->
        <form action="{{ url()->current() }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search song by title/album/artist..."
                    value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </form>

        <h3>Songs in this Playlist ({{ $songs->total() }} found):</h3>
        <table class="table table-bordered mt-3 text-center">
            <thead>
                <tr>
                    <th>Song Title</th>
                    <th>Artist</th>
                    <th>Album</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($songs as $song)
                    <tr data-song-id="{{ $song->id }}" onclick="playSong({{ $song->id }})">
                        <td class="song-title">{{ $song->song_title }}</td>
                        <td class="song-artist">{{ $song->album->artist->name ?? 'N/A' }}</td>
                        <td>{{ $song->album->album_title ?? 'N/A' }}</td>
                        <input type="hidden" class="audio-url" value="{{ Storage::url($song->audio) }}">
                        <td>
                            <!-- Form to remove song from playlist -->
                            <form
                                action="{{ route('playlist.removeSong', ['playlist' => $playlist->id, 'song' => $song->id]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No songs found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $songs->links() }}
    </div>

    <!-- Sticky Music Player -->
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
            console.log('Song played with ID:', songId); // Debug log

            // Retrieve song data from table row
            const songRow = document.querySelector(`tr[data-song-id="${songId}"]`);
            const songTitle = songRow.querySelector('.song-title').innerText;
            const songArtist = songRow.querySelector('.song-artist').innerText;
            const audioUrl = songRow.querySelector('.audio-url').value;

            // Update music player info
            document.getElementById('songTitle').innerText = songTitle;
            document.getElementById('songArtist').innerText = songArtist;

            // Update audio player source and play song
            const audioPlayer = document.getElementById('audioPlayer');
            const audioSource = document.getElementById('audioSource');
            audioSource.src = audioUrl;
            audioPlayer.load();
            audioPlayer.play();

            // Send play event to server for tracking
            fetch(`/songs/${songId}/listen`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        song_id: songId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Server response:', data); // Check server response
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
@endsection
