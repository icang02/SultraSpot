<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TourPlace>
 */
class TourPlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $price = [10000, 15000, 25000, 45000];
        return [
            'name' => fake()->sentence(2),
            'city' => fake()->city(),
            'address' => fake()->address(),
            'description' => fake()->text(),
            'ticket_stock' => rand(0, 100),
            'price' => $price[rand(0, 3)],
            'telp' => fake()->phoneNumber(),
            'image' => 'default.jpg',
            'rental' => rand(0, 1),
        ];
    }
}
