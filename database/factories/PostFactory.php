<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->name();

        return [
            'image' => NULL,
            'title' => $title,
            'slug'  => Str::slug($title),
            'content' => $this->faker->paragraph(100),
            'created_by' => $this->faker->name(),
        ];
    }
}
