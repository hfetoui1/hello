<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Administrateur;
use App\Models\Profil;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commentaire>
 */
class CommentaireFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'contenu' => $this->faker->paragraph(),

            'administrateur_id' => Administrateur::inRandomOrder()->first()?->id ?? Administrateur::factory(),
            'profil_id' => Profil::inRandomOrder()->first()?->id ?? Profil::factory(),


            //
        ];
    }
}
