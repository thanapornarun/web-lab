<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $artists = Artist::get();
        return $artists;
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:255']
        ]);

        $name = $request->get('name');

        $exist = Artist::where('name', $name)->first();
        if ($exist !== null) {
            abort(400, "Artist name '{$name}' has been used");
        }

        $artist = new Artist();
        $artist->name = $name;
        $artist->save();
        $artist->refresh();

        return $artist;
    }

    /**
     * Display the specified resource.
     */

    public function show(Artist $artist)
    {
        $songs = $artist->songs;
        return $artist;
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Artist $artist)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:255']
        ]);

        $name = $request->get('name');
        $image_path = $request->get('image_path') ?? $artist->image_path;

        $exist = Artist::where('name', $name)->where('id', '!=', $artist->id)
            ->first();

        if ($exist !== null) {
            abort(400, "Artist name '{$name}' has been used");
        }

        $artist->name = $name;
        $artist->image_path = $image_path;
        $artist->save();
        $artist->refresh();

        return $artist;
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Request $request, Artist $artist)
    {
        $name = $request->get('name');
        if ($name !== $artist->name) {
            abort(400, 'Invalid artist name, please try again and again.');
        }

        $artist->delete();
        return [
            'success' => true
        ];
    }
}
