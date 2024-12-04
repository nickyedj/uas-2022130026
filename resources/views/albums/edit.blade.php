@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <main>
            <h1>Edit Album</h1>
            <form action="{{ route('albums.update', $album->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="album_title" class="form-label">Album Title</label>
                    <input type="text" name="album_title" id="album_title" class="form-control"
                        value="{{ old('album_title', $album->album_title) }}" required>
                </div>

                <div class="mb-3">
                    <label for="artist_id" class="form-label">Artist</label>
                    <select name="artist_id" id="artist_id" class="form-select">
                        <option value="">Select Artist</option>
                        @foreach ($artists as $artist)
                            <option value="{{ $artist->id }}" {{ $album->artist_id == $artist->id ? 'selected' : '' }}>
                                {{ $artist->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="release_date" class="form-label">Release Date</label>
                    <input type="date" name="release_date" id="release_date" class="form-control"
                        value="{{ old('release_date', $album->release_date) }}" required>
                </div>
                <div class="col-6">
                    <label class="form-label" for="image">Image Cover</label>
                    <input class="form-control @error('image') is-invalid @enderror" name="image" type="file"
                        id="image" value="{{ old('image') }}">
                </div>
                <button type="submit" class="btn btn-primary">Update Album</button>
                <a href="{{ route('albums.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </main>

    </div>
@endsection
