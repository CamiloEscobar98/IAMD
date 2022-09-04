<?php

namespace Database\Factories\Tenant;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\Client\ResearchUnit;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tenant\ResearchUnit>
 */
class ResearchUnitFactory extends Factory
{
    protected $model = ResearchUnit::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => 'Unidad de Investigación ' . $this->faker->unique()->words(3, true),
            'description' => $this->faker->realText(200),
            'code' => Str::random(2)
        ];
    }
}
