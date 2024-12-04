@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ url()->current() }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search artist..."
                    value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </form>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h1>Artist List</h1>
        <main>
            @auth
                @if (Auth::user()->is_admin)
                    <a class="btn btn-primary" href="{{ route('artists.create') }}">Add New</a>
                @endif
            @endauth
            <table class="table table-bordered mt-3 text-center">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Name</th>
                        <th style="max-width: 350px; overflow: hidden; text-overflow: ellipsis;">Bio</th>
                        @auth
                            @if (Auth::user()->is_admin)
                                <th>Aksi</th>
                            @endif
                        @endauth
                    </tr>
                </thead>

                <tbody>
                    @foreach ($artists as $artist)
                        <tr>
                            <td>{{ $artist->id }}</td>
                            <td>{{ $artist->name }}</td>
                            <td style="max-width: 350px; overflow: hidden; text-overflow: ellipsis;">
                                {{ $artist->bio }}
                            </td>
                            @auth
                                @if (Auth::user()->is_admin)
                                    <td>

                                        <a href="{{ route('artists.show', $artist->id) }}" class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('artists.edit', $artist->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('artists.destroy', $artist->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this artist?')">Delete</button>
                                        </form>
                                    </td>
                                @endif
                            @endauth
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $artists->links() }}
        </main>
    </div>
@endsection
