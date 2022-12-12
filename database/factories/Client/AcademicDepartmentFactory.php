<?php

namespace Database\Factories\Client;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Client\AcademicDepartment;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client\AcademicDepartment>
 */
class AcademicDepartmentFactory extends Factory
{
    protected $model = AcademicDepartment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => 'Departamento ' . $this->faker->words(2, true),
        ];
    }
}
