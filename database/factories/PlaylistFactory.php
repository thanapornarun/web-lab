<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Song;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Playlist>
 */
class PlaylistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->realTextBetween(10, 20, 5),
            'user_id' => User::factory(),
            'song' => Song::factory(),
            'accessibility' => 'PUBLIC'
        ];
    }
}

// $table->id();
// $table->string('name');
// $table->foreignIdFor(User::class);
// $table->string('accessibility')->default('PUBLIC')->comment('PUBLIC or PRIVATE');
// $table->timestamps();
// $table->softDeletes();