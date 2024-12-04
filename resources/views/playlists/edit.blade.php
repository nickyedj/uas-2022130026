@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/music-player.css') }}">

    <div class="container">
        <main>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h1>Edit Playlist: {{ $playlist->playlist_name }}</h1>
            <!-- Form to edit the playlist details -->
            <form action="{{ route('playlists.update', $playlist->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="playlist_name" class="form-label">Playlist Name</label>
                    <input type="text" class="form-control" id="playlist_name" name="playlist_name"
                        value="{{ old('playlist_name', $playlist->playlist_name) }}" required>
                    @error('playlist_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description">{{ old('description', $playlist->description) }}</textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-warning">Update Playlist</button>
            </form>

            <!-- Search form -->
            <h2 class="mt-5">Songs in this Playlist</h2>
            <form action="{{ url()->current() }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control"
                        placeholder="Search song by title/album/artist..." value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </form>

            <!-- Display songs -->
            <table class="table table-bordered mt-3 text-center">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Song Title</th>
                        <th>Artist</th>
                        <th>Album</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($songs as $song)
                        <tr data-song-id="{{ $song->id }}" onclick="playSong({{ $song->id }})">
                            <td>{{ $song->id }}</td>
                            <td class="song-title">{{ $song->song_title }}</td>
                            <td class="song-artist">{{ $song->album->artist->name ?? 'N/A' }}</td>
                            <td>{{ $song->album->album_title ?? 'N/A' }}</td>
                            <input type="hidden" class="audio-url" value="{{ Storage::url($song->audio) }}">
                            <td>
                                <!-- Form to remove song from the playlist -->
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
                            <td colspan="6">No songs found.</td>
                        </tr>
                    @endforelse
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
            console.log('Song played with ID:', songId);

            // Dapatkan data lagu dari elemen HTML
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

            // Kirim data ke server
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
                .then(data => console.log('Server response:', data))
                .catch(error => console.error('Error:', error));
        }
    </script>
@endsection
