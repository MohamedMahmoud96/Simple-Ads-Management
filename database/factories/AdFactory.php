<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ad>
 */
class AdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->name(),
            'description' => fake()->text(),
            'type' => fake()->randomElement(['free','paid']),
            'category_id' => fake()->randomElement([Category::inRandomOrder()->first()->id]),
            'advertiser_id' => fake()->randomElement([User::inRandomOrder()->where('role', 'advertiser')->first()->id]),
            'start_date' => fake()->date(),
            'end_date'=> fake()->date(),
        ];
    }
}
