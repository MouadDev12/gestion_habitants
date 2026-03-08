<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VilleFactory extends Factory
{
    public function definition(): array
    {
        // Liste des villes marocaines
        $villes = [
            'Casablanca', 'Rabat', 'Agadir', 'Fès',
            'Marrakech', 'Tanger', 'Meknès', 'Oujda',
            'Kenitra', 'Tétouan', 'Safi', 'El Jadida'
        ];

        return [
            'ville'          => fake()->unique()->randomElement($villes),
            'nombreHabitant' => fake()->numberBetween(100000, 5000000),
        ];
    }
}