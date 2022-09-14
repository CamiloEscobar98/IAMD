<?php

namespace Database\Factories\Client\IntangibleAsset;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\Client\IntangibleAsset\IntangibleAsset;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client\IntangibleAsset\IntangibleAsset>
 */
class IntangibleAssetFactory extends Factory
{
    protected $model = IntangibleAsset::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => 'Activo Intangible ' . $this->faker->unique()->words(2, true),
        ];
    }
}
