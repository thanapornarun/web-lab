<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;
use App\Models\Song;
use Illuminate\Support\Facades\Gate;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artists = Artist::get();
        return view('artists.index', [
            'artists' => $artists
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Artist::class);
        
        return view('artists.create');
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
        Gate::authorize('create', Artist::class);

        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255']
        ]);
        
        $artists_name = $request->get('name');
        $artist = new Artist();
        $artist->name = $artists_name;
        $artist->save();
        return redirect()->route('artists.index');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Artist $artist)
    {
        return view('artists.show', ['artist' => $artist]);
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artist $artist)
    {
        Gate::authorize('update', $artist);
        return view('artists.edit', [ 'artist' => $artist]);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artist $artist)
    {
        Gate::authorize('update', $artist);
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255']
        ]);
        
        $artist->name = $request->get('name');
        $artist->save();
        return redirect()->route('artists.show', ['artist' => $artist]);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artist $artist)
    {
        Gate::authorize('destroy', $artist);

        if($artist->songs()->isEmpty()) {
            $artist->delete();
        }

        return redirect()->route('artists.index');
    }
    
    /**
     * Show the form for creating a new song of specified artist
     * HTTP method: GET
     * Route Path: /artists/{artist}/songs
     * Route Name: artists.songs.create
     */
    public function createSong(Artist $artist) {
        Gate::authorize('update', $artist);
        return view('artists.create-song', ['artist' => $artist]);
    }
    
    /**
     * Store a newly created song of specified artist in storage.
     * HTTP method: POST
     * Route Path: /artists/{artist}/songs
     * Route Name: artists.songs.store
     */
    public function storeSong(Request $request, Artist $artist) {
        Gate::authorize('update', $artist);

        $request->validate([
            'title' => ['required', 'string', 'min:4', 'max:255'],
            'duration' => ['required', 'integer', 'min:10']
        ]);

        $song = new Song(); // use App\Models\Song;
        $song->title = $request->get('title');
        $song->duration = $request->get('duration');

        $artist->songs()->save($song);

        return redirect()->route('artists.show', ['artist' => $artist]);
    }
}
