<?php

namespace Database\Factories\Client\IntangibleAsset;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\Client\IntangibleAsset\IntangibleAssetProtectionAction;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client\IntangibleAsset\IntangibleAssetProtectionAction>
 */
class IntangibleAssetProtectionActionFactory extends Factory
{
    protected $model = IntangibleAssetProtectionAction::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'reference' => $this->faker->realText(50),
        ];
    }
}
