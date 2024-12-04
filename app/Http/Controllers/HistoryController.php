<?php

namespace App\Http\Controllers;

use App\Models\UserListenHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    /**
     * Display a listing of the user's listen history.
     */
    public function index()
    {
        $history = UserListenHistory::with('song.album', 'song.artist')
            ->where('user_id', Auth::id())
            ->orderBy('listened_at', 'desc')
            ->get();

        return view('history.index', compact('history'));
    }

    public function destroyAll()
    {
        UserListenHistory::where('user_id', Auth::id())->delete();

        return redirect()->route('history.index')->with('success', 'Your listening history has been cleared.');
    }
}
