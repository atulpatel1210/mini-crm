<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'first_name_en' => $this->faker->firstName(),
            'first_name_hi' => 'पहला नाम',
            'last_name_en' => $this->faker->lastName(),
            'last_name_hi' => 'उपनाम',
            'email' => $this->faker->unique()->email(),
            'phone' => $this->faker->phoneNumber(),
        ];
    }
}
