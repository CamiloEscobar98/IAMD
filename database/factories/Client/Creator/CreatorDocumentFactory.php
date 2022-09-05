<?php

namespace Database\Factories\Client\Creator;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Client\Creator\CreatorDocument;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client\Creator\CreatorDocument>
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
