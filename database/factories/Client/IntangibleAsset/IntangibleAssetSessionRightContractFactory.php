<?php

namespace Database\Factories\Client\IntangibleAsset;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Client\IntangibleAsset\IntangibleAssetSessionRightContract;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client\IntangibleAsset\IntangibleAssetSessionRightContract>
 */
class IntangibleAssetSessionRightContractFactory extends Factory
{
    protected $model = IntangibleAssetSessionRightContract::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'owner' => $this->faker->name,
            'file' => 'example.txt',
        ];
    }
}
