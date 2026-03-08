<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            VilleSeeder::class,     // ← PREMIER (parent)
            HabitantSeeder::class,  // ← DEUXIÈME (enfant)
        ]);
    }
}