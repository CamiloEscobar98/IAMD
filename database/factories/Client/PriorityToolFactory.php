<?php

namespace Database\Factories\Client;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client\PriorityTool>
 */
class PriorityToolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => "Herramienta {$this->faker->unique()->word}",
            'description' => $this->faker->realText(50)
        ];
    }
}
