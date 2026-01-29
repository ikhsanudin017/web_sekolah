<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SchoolSetting>
 */
class SchoolSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_sekolah' => fake()->company() . ' ' . fake()->randomElement(['SD', 'SMP', 'SMA', 'SMK']),
            'visi_misi' => fake()->paragraphs(2, true),
            'logo' => fake()->imageUrl(200, 200, 'business'),
            'alamat' => fake()->address(),
            'email_kontak' => fake()->companyEmail(),
            'phone' => fake()->phoneNumber(),
            'website' => fake()->url(),
            'map_url' => 'https://www.google.com/maps/embed?pb=' . fake()->sha1(),
            'description' => fake()->paragraph(),
            'primary_color' => fake()->randomElement(['#2563eb', '#0ea5e9', '#16a34a', '#7c3aed', '#dc2626']),
        ];
    }
}

