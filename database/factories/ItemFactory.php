<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'item_name' => $this->faker->sentence(3),
            'item_desc' => $this->faker->text(),
            'item_image' => 'https://picsum.photos/seed/'.$this->faker->unique()->word.'/320',
            'price' => ($this->faker->numberBetween(10,500) * 1000),
        ];
    }
}
