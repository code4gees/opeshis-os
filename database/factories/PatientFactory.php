<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => fake()->name(),
            'medical_id' => 'PID-' . fake()->unique()->numberBetween(1000, 9999),
            'gender' => fake()->randomElement(['Male', 'Female']),
            'dob' => fake()->date('Y-m-d', '-18 years'),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'branch_id' => null,
        ];
    }
}
