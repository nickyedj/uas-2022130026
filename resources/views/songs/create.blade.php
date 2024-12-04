@extends('layouts.app')

@section('content')
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
            <h1>Create New Song</h1>

            <form action="{{ route('songs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="song_title">Song Title:</label>
                    <input type="text" id="song_title" name="song_title" class="form-control"
                        value="{{ old('song_title') }}" required>
                </div>

                <div class="form-group">
                    <label for="artist_id">Artist:</label>
                    <select id="artist_id" name="artist_id" class="form-control">
                        <option value="">Select Artist</option>
                        @foreach ($artists as $artist)
                            <option value="{{ $artist->id }}" {{ old('artist_id') == $artist->id ? 'selected' : '' }}>
                                {{ $artist->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="album_id">Album:</label>
                    <select id="album_id" name="album_id" class="form-control">
                        <option value="">Select Album</option>
                        @foreach ($albums as $album)
                            <option value="{{ $album->id }}" {{ old('album_id') == $album->id ? 'selected' : '' }}>
                                {{ $album->album_title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="genre">Genre:</label>
                    <input type="text" id="genre" name="genre" class="form-control"
                        @error('genre') is-invalid @enderror value="{{ old('genre') }}">

                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" value="{{ old('description') }}"
                        @error('description') is-invalid @enderror class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="audio">Audio File:</label>
                    <input type="file" id="audio" name="audio" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Save Song</button>
            </form>
        </main>
    </div>
@endsection
