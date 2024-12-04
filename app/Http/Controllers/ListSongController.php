<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Song;
use App\Models\Playlist;

class ListSongController extends Controller
{
    public function __construct()
    {
        // Ensuring the user is authenticated for these actions
        $this->middleware('auth');
    }


    /**
     * Add a song to a specific playlist.
     */
    public function addSongToPlaylist(Request $request, $songId)
{
    $request->validate([
        'playlist_id' => 'required|exists:playlists,id',
    ]);

    $playlist = Playlist::findOrFail($request->playlist_id);
    $song = Song::findOrFail($songId);

    $playlist->songs()->syncWithoutDetaching($song);

    return redirect()->route('songs.index')->with('success', 'Song added to playlist successfully!');
}


    /**
     * Remove a song from a specific playlist.
     */
    public function removeSongFromPlaylist(Playlist $playlist, Song $song)
{
    $user = Auth::user();

    if ($user->id !== $playlist->user_id) {
        return redirect()->route('playlists.index')->with('error', 'You do not have permission to modify this playlist.');
    }
    $playlist->songs()->detach($song);
    return redirect()->route('playlists.show', $playlist->id)->with('success', 'Song removed from playlist successfully!');
}


}
