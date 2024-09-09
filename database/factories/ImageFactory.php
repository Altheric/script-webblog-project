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
            'image_path' => 'https://picsum.photos/500', //Since placeholder.com has shut down I'll just use this.
            'image_alt' => $this->faker->sentence,
            'image_subtitle' => $this->faker->sentence,
            'article_id' => Article::inRandomOrder()->first()->id,
        ];
    }
}
