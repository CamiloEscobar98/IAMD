<?php

namespace Database\Factories\Client;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Client\SecretProtectionMeasure;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client\SecretProtectionMeasure>
 */
class SecretProtectionMeasureFactory extends Factory
{
    protected $model = SecretProtectionMeasure::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => "Medida {$this->faker->unique()->word}"
        ];
    }
}
