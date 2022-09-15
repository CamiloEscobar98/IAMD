<?php

namespace Database\Factories\Admin;

use App\Models\Admin\ExternalOrganization;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExternalOrganization>
 */
class ExternalOrganizationFactory extends Factory
{
    /** @var Model */
    protected $model = ExternalOrganization::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $nit = $this->faker->randomNumber(2) . $this->faker->randomNumber(2) . $this->faker->randomNumber(4) . $this->faker->randomNumber(2);
        return [
            'nit' => $nit,
            'name' => $this->faker->unique()->company,
            'email' => $this->faker->unique()->companyEmail,
            'telephone' => $this->faker->phoneNumber,
            'address' => $this->faker->address
        ];
    }
}
