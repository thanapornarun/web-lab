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

        // $song = new Song();
        // $song->title = "River";
        // $song->artist = "Miley Cyrus";
        // $song->duration = 3 * 60 + 20;
        // $song->save();

        // $song = new Song();
        // $song->title = "Song for you";
        // $song->artist = "Lee Isaacs";
        // $song->duration = 2 * 60 + 48;
        // $song->save();

        // $song = new Song();
        // $song->title = "คำถามซึ่งไร้คนตอบ";
        // $song->artist = "Getsunova";
        // $song->duration = 4 * 60 + 29;
        // $song->save();

        // Song::factory(1000)->create();

        Song::factory()
        ->count(10)
        ->for(Artist::factory()->state([
            'name' => fake()->name(),
        ]))
        ->create();
    }
}
