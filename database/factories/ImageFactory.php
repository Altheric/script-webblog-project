<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Article;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image_data' => $this->faker->emoji, //Since placeholder.com has shut down, this is unfortunately the best next thing.
            'image_alt' => $this->faker->sentence,
            'image_subtitle' => $this->faker->sentence,
            'article_id' => Article::inRandomOrder()->first()->id,
        ];
    }
}
