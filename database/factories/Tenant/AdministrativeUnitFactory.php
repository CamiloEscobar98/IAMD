<?php

namespace Database\Factories\Tenant;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Client\AdministrativeUnit;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client\AdministrativeUnit>
 */
class AdministrativeUnitFactory extends Factory
{
    protected $model = AdministrativeUnit::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => 'Unidad Administrativa ' . $this->faker->words(2, true),
            'info' => $this->faker->realText(200)
        ];
    }
}
