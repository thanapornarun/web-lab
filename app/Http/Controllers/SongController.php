<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;

class SongController extends Controller
{
    public function index() {
        $songs = Song::with('artist')->paginate(20);


        return view('songs.index', [
            'title' => 'Song Playlist',
            'songs' => $songs
        ]);
    }
}
