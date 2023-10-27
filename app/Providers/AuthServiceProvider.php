<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Artist;
use App\Models\Playlist;
use App\Policies\ArtistPolicy;
use App\Policies\PlaylistPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Playlist::class => PlaylistPolicy::class,
        Artist::class => ArtistPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
