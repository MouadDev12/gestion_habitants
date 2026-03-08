<?php

namespace Database\Factories;

use App\Models\Ville;
use Illuminate\Database\Eloquent\Factories\Factory;

class HabitantFactory extends Factory
{
    public function definition(): array
    {
        // Générer un CIN marocain aléatoire
        $lettres = ['A', 'B', 'C', 'D', 'E', 'G', 'H', 'I', 'J', 'K'];
        $cin = fake()->randomElement($lettres)
             . fake()->randomElement($lettres)
             . fake()->numerify('######');

        return [
            'cin'      => $cin,
            'nom'      => fake()->lastName(),
            'prenom'   => fake()->firstName(),
            'photo'    => null,
            'ville_id' => Ville::inRandomOrder()->first()?->id ?? Ville::factory(),
            // ↑ prend une ville existante au hasard
            // si aucune ville → en crée une nouvelle
        ];
    }
}