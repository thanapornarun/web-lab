<?php

namespace App\Http\Controllers;

use App\Models\Enums\PlaylistAccessibility;
use App\Repositories\PlaylistRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redis;

use App\Models\Playlist;

class PlaylistController extends Controller
{
    protected $playlistRepository;
    /**
     * Display a listing of the resource.
     */

    public function __construct() {
        $this->playlistRepository= new PlaylistRepository(); 
    }

    public function index()
    {
        Gate::authorize('viewAny', Playlist::class);

        $user = auth::user();
        $playlists = Playlist::withCount('songs')->ofUser($user->id)->get();
        // dd($playlists);
        $playlistsKey = "playlists:{$user->email}";
        $value = Redis::get('');

        if (empty($value)) {
            $playlists = Playlist::withCount('songs')->ofUser($user->id)->get();
            Redis::set($playlistsKey, json_encode($playlists));
        } else {
            $playlists = json_decode($value);
        }

        return view('playlists.index', [
            'playlists' => $playlists
        ]);
    }

    /**
     * Show the form for creating a new rpesource.
     */
    public function create()
    {
        Gate::authorize('create', Playlist::class);
        return view('playlists.create');
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Playlist::class);

        $request->validate([
            'name' => ['required' , 'string', 'min:4', 'max:100']
        ]);
        
        $playlist = new Playlist();
        $playlist->name = $request->get('name');
        $playlist->accessibility = PlaylistAccessibility::PRIVATE;
        $request->user()->playlists()->save($playlist);

        return redirect()->route('playlists.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Playlist $playlist)
    {   
        Gate::authorize('update', $playlist);

        return view('playlists.edit', ['playlist => $playlist']);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Playlist $playlist)
    {
        Gate::authorize('update', $playlist);
        
        $request->validate([
            'name' => ['required' , 'string', 'min:4', 'max:100']
        ]);

        $playlist->name = $request->get('name');
        $playlist->save();

        $this->playlistRepository->updatePlaylistCacheOfUser($request->user());

        return redirect() -> route('playlist.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
