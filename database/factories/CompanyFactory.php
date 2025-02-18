<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_en' => $this->faker->company(),
            'name_hi' => 'परीक्षण कंपनी',
            'email' => $this->faker->unique()->companyEmail,
            'website' => $this->faker->url,
            'logo' => $this->faker->imageUrl(200, 200, 'business', true, 'Company Logo'),
        ];
    }
}
