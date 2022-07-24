<?php

namespace Database\Factories\Task1;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task1\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'         => $this->faker->text(50),
            'category_id'   => $this->faker->numberBetween(1,8),
            'in_stock'      => $this->faker->numberBetween(0,1)
        ];
    }
}
