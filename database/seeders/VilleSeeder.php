<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Ville;

class VilleSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('habitants')->truncate();
        DB::table('villes')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Ville::factory(8)->create();

        $this->command->info('✅ 8 villes créées !');
    }
}