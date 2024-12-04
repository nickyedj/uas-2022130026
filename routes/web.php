<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\PlaylistController;
use App\Models\Playlist;
use App\Http\Controllers\ListSongController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\HistoryController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', MainController::class);


Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::resource('artists', ArtistController::class);
    Route::resource('albums', AlbumController::class);
    Route::resource('songs', SongController::class);
    Route::resource('playlists', PlaylistController::class);
    Route::get('history', [HistoryController::class, 'index'])->name('history.index');
    Route::post('/songs/{songId}/listen', [SongController::class, 'trackListen']);
    Route::post('/playlist/{playlistId}/listen', [PlaylistController::class, 'trackListen']);
    Route::get('playlist/{playlistId}', [ListSongController::class, 'index'])->name('listsong');
    Route::post('songs/{songId}/add-to-playlist', [ListSongController::class, 'addSongToPlaylist'])->name('playlist.addSong');
    Route::delete('/history/destroy-all', [HistoryController::class, 'destroyAll'])->name('history.destroyAll');
    Route::delete('playlists/{playlist}/songs/{song}', [ListSongController::class, 'removeSongFromPlaylist'])->name('playlist.removeSong');
});

// Route::resource('artists',ArtistController::class);
// Route::resource('albums',AlbumController::class);
// Route::resource('songs',SongController::class);
//Route::resource('playlists', PlaylistController::class)->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
