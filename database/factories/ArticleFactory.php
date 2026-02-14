<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'url' => $this->faker->unique()->url,
            'source_name' => $this->faker->company,
            'author' => $this->faker->name,
            'category' => $this->faker->word,
            'published_at' => now(),
            'api_provider' => 'manual',
        ];
    }
}
