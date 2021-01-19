<?php

namespace Database\Factories;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

class HotelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Hotel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Hotel '.$this->faker->unique()->company,
            'description' => $this->faker->words($nb = 128, $asText = true),
            'images' => $this->faker->imageUrl($width = 320, $height = 160),
            'address' => $this->faker->unique()->address,
            'phone' => $this->faker->unique()->tollFreePhoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'latitude' => $this->faker->latitude($min = -1, $max = 1.352083),
            'longitude' => $this->faker->longitude($min = -100, $max = 103.819836),
            // 'rating' => 0,
            'click_counter' => 0,
            'owner_id' => $this->faker->unique()->numberBetween(1, \App\Models\User::count()),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
