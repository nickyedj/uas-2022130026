@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ url()->current() }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search album..."
                    value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </form>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h1>Album List</h1>
        <main>
            @auth
                @if (Auth::user()->is_admin)
                    <a href="{{ route('albums.create') }}" class="btn btn-primary">Add Album</a>
                @endif
            @endauth
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Album Image</th>
                        <th>Album Title</th>
                        <th>Artist</th>
                        <th>Release date</th>
                        <th>Total songs</th>
                        @auth
                            @if (Auth::user()->is_admin)
                                <th>Action</th>
                            @endif
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @foreach ($albums as $album)
                        <tr>
                            <td>{{ $album->id }}</td>
                            <td>
                                @if ($album->image)
                                    <img src="{{ Storage::url($album->image) }}" style="width: 50px; height: auto;">
                                @else
                                    <span>N/A</span>
                                @endif
                            </td>
                            <td>{{ $album->album_title }}</td>
                            <td>{{ $album->artist->name ?? 'N/A' }}</td>
                            <td>{{ $album->release_date }}</td>
                            <td>{{ $album->songs->count() }}</td>
                            @auth
                                @if (Auth::user()->is_admin)
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Actions">
                                            <a href="{{ route('albums.show', $album->id) }}"
                                                class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('albums.edit', $album->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('albums.destroy', $album->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this artist?')">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                            @endauth
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $albums->links() }}
        </main>
    </div>
@endsection
