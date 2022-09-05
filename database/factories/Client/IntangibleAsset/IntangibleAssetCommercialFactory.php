<?php

namespace Database\Factories\Client\IntangibleAsset;

use App\Models\Client\IntangibleAsset\IntangibleAssetCommercial;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client\IntangibleAsset\IntangibleAssetCommercial>
 */
class IntangibleAssetCommercialFactory extends Factory
{
    protected $model = IntangibleAssetCommercial::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'reason' => $this->faker->realText(200)
        ];
    }
}
