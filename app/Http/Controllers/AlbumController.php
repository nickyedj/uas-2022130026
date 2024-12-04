<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $albums = Album::query();
        if ($request->has('search')) {
            $albums->where('album_title', 'like', "%{$request->search}%");
        }
        $albums = $albums->paginate(10)->appends($request->only('search'));
        return view('albums.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $artists = Artist::all();

        return view('albums.create', compact('artists'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'album_title' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'release_date' => 'nullable|date',
        ]);

        $album = Album::create($request->all());
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageFileName = $imageFile->hashName();
            $imageFilePath = $imageFile->storeAs('public/album_images', $imageFileName);
            $album->update(['image' => $imageFilePath]);
        }

        return redirect()->route('albums.index')->with('success', 'Album added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        $album->load('artist', 'songs');
        return view('albums.show', compact('album'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        $artists = Artist::all();
        return view('albums.edit', compact('album', 'artists'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        $request->validate([
            'album_title' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'release_date' => 'nullable|date',
            'artist_id' => 'nullable|exists:artists,id',
        ]);
        $album = Album::where('id', $album->id);
        $album->update($request->except(['_token', '_method']));
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageFileName = $imageFile->hashName();
            $imageFilePath = $imageFile->storeAs('public/album_images', $imageFileName);
            $album->update(['image' => $imageFilePath]);
        }

        return redirect()->route('albums.index')->with('success', 'Album updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        $album->delete();
        return redirect()->route('albums.index');
    }
}
