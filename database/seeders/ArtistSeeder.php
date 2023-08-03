<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Artist;
use App\Models\Song;

class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Artist::factory()
        ->count(10)
        ->has(Song::factory()->count(3))
        ->create();
    }
}
