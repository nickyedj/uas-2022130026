<?php

namespace App\Http\Controllers;
use App\Models\Song;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $songs = Song::paginate(10);
        return view('main', compact('songs'));
    }
}
