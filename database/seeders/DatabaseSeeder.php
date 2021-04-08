<?php

namespace Database\Seeders;
use App\Models\Contador;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $contador = new Contador();

        $contador->movil_index = 0;
        $contador->save();
    }
}
