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
            <form action="{{ route('albums.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <label class="form-label" for="album_title">Album title</label>
                        <input class="form-control @error('album_title') is-invalid @enderror" type="text"
                            name="album_title" id="album_title" value="{{ old('album_title') }}">
                    </div>
                    <div class="col">
                        <label class="form-label" for="release_date">Tanggal Rilis</label>
                        <input id="release_date" class="form-control w-50" type="date" name="release_date" />
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
                    <div class="col-6">
                        <label class="form-label" for="image">Image Cover</label>
                        <input class="form-control @error('image') is-invalid @enderror" name="image" type="file"
                            id="image" value="{{ old('image') }}">
                    </div>

                    <button class="btn btn-primary mt-3" type="submit"> Add </button>
                </div>
            </form>
        </main>
    </div>
@endsection
