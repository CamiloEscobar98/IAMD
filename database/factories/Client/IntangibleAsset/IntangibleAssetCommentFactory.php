<?php

namespace Database\Factories\Client\IntangibleAsset;

use App\Models\Client\IntangibleAsset\IntangibleAssetComment;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client\IntangibleAsset\IntangibleAssetComment>
 */
class IntangibleAssetCommentFactory extends Factory
{
    protected $model = IntangibleAssetComment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'message' => $this->faker->realText(200)
        ];
    }
}
