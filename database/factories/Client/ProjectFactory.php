<?php

namespace Database\Factories\Client;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Client\Project\Project;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client\Project\Project>
 */
class ProjectFactory extends Factory
{
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => 'Proyecto ' . $this->faker->unique()->words(3, true),
            'description' => $this->faker->realText(200),
        ];
    }
}
