<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Brand::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'contact_email' => $this->faker->unique()->safeEmail(),
            'contact_name' => $this->faker->name(),
            'contact_phone' => $this->faker->numerify('##########'),
            'discount' => $this->faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 1)
        ];

    }
}
