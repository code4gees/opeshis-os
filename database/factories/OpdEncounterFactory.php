<?php

namespace Database\Factories;

use App\Models\OpdEncounter;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OpdEncounter>
 */
class OpdEncounterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(),
            'encounter_number' => 'OPD-' . fake()->unique()->numberBetween(10000, 99999),
            'check_in_time' => now(),
            'assigned_doctor_id' => User::factory(),
            'triage_category' => 'Green',
            'status' => 'waiting',
            'branch_id' => null,
        ];
    }
}
