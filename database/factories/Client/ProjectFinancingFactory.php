<?php

namespace Database\Factories\Client;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Client\Project\ProjectFinancing;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client\Project\Project>
 */
class ProjectFinancingFactory extends Factory
{
    protected $model =  ProjectFinancing::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'contract' => 'Contract ' . $this->faker->realText(50),
            'date' => $this->faker->dateTimeBetween('-5 years', '-2 months')
        ];
    }
}
