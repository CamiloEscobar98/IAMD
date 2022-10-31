<?php

namespace Database\Factories\Client\IntangibleAsset;

use App\Models\Client\IntangibleAsset\IntangibleAssetLocalization;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client\IntangibleAsset\IntangibleAssetLocalization>
 */
class IntangibleAssetLocalizationFactory extends Factory
{
    protected $model = IntangibleAssetLocalization::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'localization' => $this->faker->words('4', true),
        ];
    }
}
