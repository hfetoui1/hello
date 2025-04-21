<?php

namespace Database\Seeders;

use App\Models\Commentaire;
use App\Models\Administrateur;
use App\Models\Profil;
use Illuminate\Database\Seeder;

class CommentaireSeeder extends Seeder
{
    public function run(): void
    {
        $administrateurs = Administrateur::all();
        $profils = Profil::all();
        $this->command->info('➡️ Démarrage du seeder CommentaireSeeder...');

        foreach ($administrateurs as $admin) {
            $profilsACommenter = $profils->random(rand(1, min(5, $profils->count())));
            $this->command->info('➡️ Démarrage du seeder for admin...');

            foreach ($profilsACommenter as $profil) {
                // Vérifie que la paire est unique (par précaution)
                if (!Commentaire::where('administrateur_id', $admin->id)
                    ->where('profil_id', $profil->id)
                    ->exists()) {
                        $this->command->info('add new');

                    Commentaire::factory()->create([
                        'administrateur_id' => $admin->id,
                        'profil_id' => $profil->id,
                    ]);
                }
            }
        }
    }
}
