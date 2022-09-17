<?php

namespace Database\Factories\Client\IntangibleAsset;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Client\IntangibleAsset\IntangibleAssetPublished;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client\IntangibleAsset\IntangibleAssetPublished>
 */
class IntangibleAssetPublishedFactory extends Factory
{
    protected $model = IntangibleAssetPublished::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $informationScopes = collect([1 => 'Premilinar', 2 => 'Parcial', 3 => 'Total']);

        return [
            'published_in' => $this->faker->words(4, true),
            'information_scope' => $informationScopes->random(1)->first(),
            'published_at' => $this->faker->dateTimeBetween('-60 years', '-5 months')
        ];
    }
}
