<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $artists = Artist::query();
        if ($request->has('search')) {
            $artists->where('name', 'like', "%{$request->search}%");
        }
        $artists = $artists->paginate(10)->appends($request->only('search'));
        return view('artists.index', compact('artists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('artists.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'bio' => 'nullable|string|max:255',
        ]);

        $artist =Artist::create([
            'name' => $request->name,
            'bio' => $request->bio,
        ]);

        return redirect()->route('artists.index')->with('success', 'Artist added successfully.');
    }

    public function show(Artist $artist)
    {
        return view('artists.show', compact('artist'));
    }

    public function edit(Artist $artist)
    {
        return view('artists.edit', compact('artist'));
    }

    public function update(Request $request, Artist $artist)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'bio' => 'nullable|string|max:255',
        ]);

        $artist->update([
            'name' => $request->name,
            'bio' => $request->bio,
        ]);

        return redirect()->route('artists.index')->with('success', 'Artist updated successfully.');
    }
    public function destroy(Artist $artist)
    {
        $artist->delete();
        return redirect()->route('artists.index');
    }
}
