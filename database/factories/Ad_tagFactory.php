<?php

namespace Database\Factories;

use App\Models\Ad;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class Ad_tagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'ads_id' => fake()->randomElement([Ad::inRandomOrder()->first()->id]),
            'tags_id' => fake()->randomElement([Tag::inRandomOrder()->first()->id]),

        ];
    }
}
