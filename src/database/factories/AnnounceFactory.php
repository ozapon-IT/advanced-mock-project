<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Announce>
 */
class AnnounceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->locale('ja_JP');

        return [
            'title' => $this->faker->realText(20),
            'body' => $this->faker->realText(200),
            'sent_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}