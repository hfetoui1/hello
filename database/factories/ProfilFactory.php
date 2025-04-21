<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profil>
 */
class ProfilFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,
            'administrateur_id' => 1, // rand(1, 10),
            'image' => '/avatars/avatar_1.jpg',
            'statut' => $this->faker->randomElement(['inactif', 'en attente', 'actif']),
        ];
    }
}
