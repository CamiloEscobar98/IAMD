<?php

namespace Database\Factories\Client\IntangibleAsset;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Client\IntangibleAsset\IntangibleAssetAcademicRecord;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client\IntangibleAsset\IntangibleAssetAcademicRecord>
 */
class IntangibleAssetAcademicRecordFactory extends Factory
{
    protected $model = IntangibleAssetAcademicRecord::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'entity' => $this->faker->company,
            'administrative_record_num' => "{$this->faker->word()}-{$this->faker->randomNumber(3)}",
            'date' => $this->faker->dateTimeBetween('-5 years', 'now'),
            'file' => 'example.txt',
        ];
    }
}
