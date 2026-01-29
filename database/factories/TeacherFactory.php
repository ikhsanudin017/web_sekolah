<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'nip' => fake()->unique()->numerify('##########'),
            'position' => fake()->randomElement([
                'Kepala Sekolah',
                'Wakil Kepala Sekolah',
                'Guru Mata Pelajaran',
                'Guru Wali Kelas',
                'Guru BK',
                'Staf Administrasi',
            ]),
            'photo' => fake()->imageUrl(300, 300, 'people'),
            'bio' => fake()->paragraph(),
            'media_sosial_json' => [
                'facebook' => fake()->optional()->url(),
                'instagram' => fake()->optional()->userName(),
                'twitter' => fake()->optional()->userName(),
                'linkedin' => fake()->optional()->url(),
            ],
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'order' => fake()->numberBetween(0, 100),
            'is_active' => true,
        ];
    }

    /**
     * Indicate that the teacher is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}

