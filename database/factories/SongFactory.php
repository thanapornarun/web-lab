<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Artist;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Song>
 */
class SongFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'title' => fake()->realTextBetween(10, 20, 5),
           'artist_id' => Artist::inRandomorder()->first()->id,
           'duration' => fake()->numberBetween(2 * 60, 5 * 60)
        ];
    }
}