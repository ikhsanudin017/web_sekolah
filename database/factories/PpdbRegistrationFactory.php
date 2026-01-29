<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PpdbRegistration>
 */
class PpdbRegistrationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_lengkap' => fake()->name(),
            'nisn' => fake()->unique()->numerify('##########'),
            'asal_sekolah' => fake()->company() . ' ' . fake()->randomElement(['SD', 'SMP', 'MI', 'MTs']),
            'email' => fake()->unique()->safeEmail(),
            'no_hp' => fake()->phoneNumber(),
            'status' => fake()->randomElement(['pending', 'proses', 'diterima']),
            'notes' => fake()->optional()->sentence(),
        ];
    }

    /**
     * Indicate that the registration is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
        ]);
    }

    /**
     * Indicate that the registration is in process.
     */
    public function proses(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'proses',
        ]);
    }

    /**
     * Indicate that the registration is accepted.
     */
    public function diterima(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'diterima',
        ]);
    }
}

