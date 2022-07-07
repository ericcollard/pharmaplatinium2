<?php

namespace Database\Factories;

use App\Models\OrderTemplateContent;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderTemplateContentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderTemplateContent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ean' => $this->faker->numerify('##########'),
            'ordertemplate_id' => $this->faker->numberBetween($min = 1, $max = 6),
            'name' => $this->faker->word(),
            'variant' => $this->faker->word(), // password
            'price' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 50),
            'step_price' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 50),
            'step_value' => $this->faker->numberBetween($min = 10, $max = 100),
            'package_qty' => $this->faker->numberBetween($min = 2, $max = 30),
            'comment' => $this->faker->word(),
        ];


    }
}
