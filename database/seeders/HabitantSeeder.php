<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ville;
use App\Models\Habitant;

class HabitantSeeder extends Seeder
{
    public function run(): void
    {
        $villes = Ville::all();

        foreach ($villes as $ville) {
            $nombre = rand(5, 10);

            Habitant::factory($nombre)->create([
                'ville_id' => $ville->id
            ]);

            $this->command->info("✅ {$nombre} habitants pour {$ville->ville}");
        }

        $this->command->info('🎉 Total : ' . Habitant::count() . ' habitants !');
    }
}