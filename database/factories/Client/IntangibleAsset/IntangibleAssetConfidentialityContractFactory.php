<?php

namespace Database\Factories\Client\IntangibleAsset;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Client\IntangibleAsset\IntangibleAssetConfidentialityContract;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client\IntangibleAsset\IntangibleAssetConfidentialityContract>
 */
class IntangibleAssetConfidentialityContractFactory extends Factory
{
    protected $model = IntangibleAssetConfidentialityContract::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'organization_confidenciality' => $this->faker->company,
            'file_url' => $this->faker->imageUrl,
        ];
    }
}
