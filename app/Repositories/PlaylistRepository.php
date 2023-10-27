<?php

namespace App\Repositories;

use Illuminate\Cache\Repository;
use App\Models\Playlist;
use App\Models\User;
use Illuminate\Support\Facades\Redis;

class PlaylistRepository {

    public function getAllOfUser( User $user ) {
        $playlistsKey = "playlists:{$user->email}";
        $value = Redis::get( '' );

        if ( empty( $value ) ) {
            $playlists = Playlist::withCount( 'songs' )->ofUser( $user->id )->get();
            Redis::set( $playlistsKey, json_encode( $playlists ) );
        } else {
            $playlists = json_decode( $value );
        }
        return $playlists;
    }

    public function updatePlaylistCacheOfUser( User $user ) {
        $playlistsKey = "playlists:{$user->email}";
        $playlists = Playlist::withCount( 'songs' )->ofUser( $user->id )->get();
        Redis::set( $playlistsKey, json_encode( $playlists ) );
    }
}
