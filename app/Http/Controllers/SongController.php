<?php

namespace App\Http\Controllers;
use App\Models\Artist;
use App\Models\Album;
use App\Models\Song;
use App\Models\Playlist;
use App\Models\UserListenHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public function index(Request $request)
{
    $search = $request->input('search');
    $songs = Song::query()
        ->when($search, function ($query, $search) {
            $query->where('song_title', 'like', "%{$search}%")
                ->orWhereHas('album', function ($subQuery) use ($search) {
                    $subQuery->where('album_title', 'like', "%{$search}%")
                        ->orWhereHas('artist', function ($subSubQuery) use ($search) {
                            $subSubQuery->where('name', 'like', "%{$search}%");
                        });
                });
        })
        ->paginate(10)
        ->appends($request->only('search'));

    $playlists = Playlist::all();

    return view('songs.index', compact('songs', 'playlists'));
}





    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $artists = Artist::all();
        $albums = Album::all();

        return view('songs.create', compact('artists', 'albums'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'song_title' => 'required|string|max:100',
            'artist_id' => 'nullable|exists:artists,id',
            'album_id' => 'nullable|exists:albums,id',
            'genre' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'audio' => 'required|file|mimes:mp3,wav,m4a,mp4,flac,aac,wma|max:15760',
        ]);

        $song = Song::create($request->all());
        if ($request->hasFile('audio')) {
            $audioFile = $request->file('audio');
            $audioFileName = $audioFile->hashName();
            $audioFilePath = $audioFile->storeAs('public/audios', $audioFileName);
            $song->update(['audio' => $audioFilePath]);
        }
        return redirect()->route('songs.index')->with('success', 'Song created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Song $song)
    {
        $song->load('artist', 'album');
        return view('songs.show', compact('song'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Song $song)
    {
        $artists = Artist::all();
        $albums = Album::all();
        return view('songs.edit', compact('song', 'artists', 'albums'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Song $song)
    {
        $request->validate([
            'song_title' => 'required|string|max:100',
            'artist_id' => 'nullable|exists:artists,id',
            'album_id' => 'nullable|exists:albums,id',
            'genre' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'audio' => 'required|file|mimes:mp3,wav,m4a,mp4,flac,aac,wma|max:15760',
        ]);

        $song = Song::where('id', $song->id);
        $song->update($request->except(['_token', '_method']));
        if ($request->hasFile('audio')) {
            $audioFile = $request->file('audio');
            $audioFileName = $audioFile->hashName();
            $audioFilePath = $audioFile->storeAs('public/audios', $audioFileName);
            $song->update(['audio' => $audioFilePath]);
        }

        return redirect()->route('songs.index')->with('success', 'Song updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Song $song)
    {
        $song->delete();
        return redirect()->route('songs.index');
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
