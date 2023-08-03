<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Playlist;
use App\Models\User;
use App\Models\Song;



class PlaylistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Playlist::factory()
        ->count(10)
        ->for(User::factory()->state([
            'name' => fake()->name(),
        ]))
        ->hasAttached(
            Song::factory()->count(3),
            ['active' => true]
        )
        ->create();
    }
}
