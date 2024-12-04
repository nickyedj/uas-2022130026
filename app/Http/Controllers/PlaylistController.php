<?php

namespace App\Http\Controllers;
use App\Models\Playlist;
use App\Models\Song;
use App\Models\UserListenHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $search = $request->input('search');

        $playlists = Playlist::query()
            ->where('user_id', Auth::id()) // Hanya ambil playlist milik user yang sedang login
            ->when($search, function ($query, $search) {
                $query->where('playlist_name', 'like', '%' . $search . '%');
            })
            ->paginate(10)
            ->appends($request->only('search'));

        return view('playlists.index', compact('playlists', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('playlists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'playlist_name' => 'required|max:255',
            'description' => 'nullable|string',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $playlist = Playlist::create([
            'playlist_name' => $request->playlist_name,
            'description' => $request->description,
            'user_id' => Auth::id(),  // Ensure that the authenticated user is set as the owner of the playlist
        ]);

        return redirect()->route('playlists.index')->with('success', 'Playlist created successfully!');
    }



    /**
     * Display the specified resource.
     */
    public function show(Request $request, Playlist $playlist)
    {
        $search = $request->input('search');

        $playlist->load('user', 'songs.album.artist');

        $songs = $playlist->songs()
            ->when($search, function ($query, $search) {
                $query->where('song_title', 'like', '%' . $search . '%')
                    ->orWhereHas('album', function ($subQuery) use ($search) {
                        $subQuery->where('album_title', 'like', '%' . $search . '%')
                            ->orWhereHas('artist', function ($subSubQuery) use ($search) {
                                $subSubQuery->where('name', 'like', '%' . $search . '%');
                            });
                    });
            })
            ->paginate(10)
            ->appends($request->only('search'));

            return view('playlists.show', compact('playlist', 'songs', 'search'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Playlist $playlist)
    {
        $search = $request->input('search');

        $playlist->load('songs.album.artist');

        $songs = $playlist->songs()
            ->when($search, function ($query, $search) {
                $query->where('song_title', 'like', '%' . $search . '%')
                    ->orWhereHas('album', function ($subQuery) use ($search) {
                        $subQuery->where('album_title', 'like', '%' . $search . '%')
                            ->orWhereHas('artist', function ($subSubQuery) use ($search) {
                                $subSubQuery->where('name', 'like', '%' . $search . '%');
                            });
                    });
            })
            ->paginate(10)
            ->appends($request->only('search'));

            return view('playlists.edit', compact('playlist', 'songs', 'search'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Playlist $playlist)
    {
        $request->validate([
            'playlist_name' => 'required|max:255',
            'description' => 'nullable|string',
        ]);

        $playlist->update([
            'playlist_name' => $request->playlist_name,
            'description' => $request->description,
        ]);

        return redirect()->route('playlists.index')->with('success', 'Playlist updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Playlist $playlist)
    {
        $playlist->delete();
        return redirect()->route('playlists.index')->with('success', 'Playlist deleted successfully!');
    }
    public function trackListen($songId)
    {
        if (Auth::check()) {
            UserListenHistory::create([
                'user_id' => Auth::id(),
                'song_id' => $songId,
                'listened_at' => now(),
            ]);
        }
        return response()->json(['status' => 'success']);
    }
}
