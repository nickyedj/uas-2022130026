@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>My Listening History</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($history->isEmpty())
            <p>You have no listening history yet.</p>
        @else
            <!-- Delete All Button -->
            <form action="{{ route('history.destroyAll') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete all your listening history?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mb-3">Delete All History</button>
            </form>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Song Title</th>
                        <th>Album</th>
                        <th>Artist</th>
                        <th>Listened At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($history as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->song->song_title }}</td>
                            <td>{{ $item->song->album ? $item->song->album->album_title : 'N/A' }}</td>
                            <td>{{ $item->song->artist ? $item->song->artist->name : 'N/A' }}</td>
                            <td>{{ $item->listened_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
