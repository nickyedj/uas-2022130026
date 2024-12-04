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
            <h1>Create Playlist</h1>
            <form action="{{ route('playlists.store') }}" method="POST">
                @csrf
                <div class="mb-3">

                    <label for="playlist_name" class="form-label">Playlist Name</label>
                    <input type="text" class="form-control" id="playlist_name" name="playlist_name"
                        value="{{ old('playlist_name') }}" required>
                    @error('playlist_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Create Playlist</button>
            </form>

        </main>

    </div>
@endsection
