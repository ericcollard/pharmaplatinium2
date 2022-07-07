<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ordertemplatecontent_id' => $this->faker->numberBetween($min = 7, $max = 20),
            'user_id' => $this->faker->numberBetween($min = 1, $max = 5),
            'qty' => $this->faker->numberBetween($min = 20, $max = 100),
            'comment' => $this->faker->text(),
        ];
    }
}
