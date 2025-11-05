<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Event Dangdut',
            'start' => Carbon::parse('2024-10-14, 09:00:00'),
            'end' => Carbon::parse('2024-10-14, 11:00:00'),
            'image' => asset('assets/event.jpg'),
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod',
        ];
    }
}
