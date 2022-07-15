<?php

namespace Database\Factories\Tenant\Creator;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Tenant\Creator\CreatorDocument;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tenant\CreatorDocument>
 */
class CreatorDocumentFactory extends Factory
{
    protected $model = CreatorDocument::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'document' => $this->faker->randomNumber(5) . $this->faker->randomNumber(5),
        ];
    }
}
