<?php

namespace Database\Factories;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnnouncementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Announcement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'messages' => $this->faker->realText($maxNbChars = 128, $indexSize = 2),
            // 'messages' => $this->faker->words($nb = 128, $asText = true),
            'hotel_id' => $this->faker->numberBetween(1, \App\Models\Hotel::count()),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
