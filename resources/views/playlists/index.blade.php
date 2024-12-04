@extends('layouts.app')

@section('content')

<div class="container">
    <form action="{{ url()->current() }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search Playlist..."
                value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
    </form>
    <h1 class="my-4">Playlists</h1>
    <a href="{{ route('playlists.create') }}" class="btn btn-primary mb-3">Create Playlist</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>User</th>
                <th>Total Songs</th>
                <th>Actions</th>

            </tr>
        </thead>
        <tbody>
            @foreach($playlists as $playlist)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $playlist->playlist_name }}</td>
                <td>{{ $playlist->description }}</td>
                <td>{{ $playlist->user->name }}</td>
                <td>{{ $playlist->songs->count() }}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Actions">
                    <a href="{{ route('playlists.show', $playlist->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('playlists.edit', $playlist->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('playlists.destroy', $playlist->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
