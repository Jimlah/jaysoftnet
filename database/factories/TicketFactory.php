<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'closed_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }


    public function open()
    {
        return $this->state(function (array $attributes) {
            return [
                'closed_at' => null,
            ];
        });
    }
}
