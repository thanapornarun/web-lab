<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Song;
use App\Models\Artist;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $total = Song::count();
        if (Song::count() > 0) {
            echo "There are {$total} song in Database \n";
            return;
        }

        Song::factory()->count(50)->create();
    }
}
