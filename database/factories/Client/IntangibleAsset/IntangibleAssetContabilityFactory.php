<?php

namespace Database\Factories\Client\IntangibleAsset;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Client\IntangibleAsset\IntangibleAssetContability;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client\IntangibleAsset\IntangibleAssetContability>
 */
class IntangibleAssetContabilityFactory extends Factory
{
    protected $model = IntangibleAssetContability::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'price' => rand(1, 100) * 1000,
            'comments' => $this->faker->realText()
        ];
    }
}
