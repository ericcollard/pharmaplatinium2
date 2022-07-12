<?php

namespace Database\Factories;

use App\Models\OrderTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderTemplateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderTemplate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'dead_line' => now()->addDays(30),
            'franco' => 1000,
            'brand_id' => $this->faker->numberBetween($min = 1, $max = 4),
            'comment' => $this->faker->text(),
            'status' => $this->faker->randomElement(['Brouillon', 'Ouverte', 'Fermée', 'Livrée']),
        ];
    }
}
