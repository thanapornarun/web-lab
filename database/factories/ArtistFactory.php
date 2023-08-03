<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artist>
 */
class ArtistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->numberBetween(1,5000),
            'name' => fake()->name()
        ];
    }
}

// $table->id();
// $table->string('name');
// $table->string('image_path')->nullable();

// $table->timestamps();
// $table->softDeletes(); // `delected_at` timestamp nullable