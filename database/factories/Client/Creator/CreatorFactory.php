<?php

namespace Database\Factories\Client\Creator;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Client\Creator\Creator;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client\Creator\Creator>
 */
class CreatorFactory extends Factory
{
    protected $model = Creator::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
        ];
    }
}
