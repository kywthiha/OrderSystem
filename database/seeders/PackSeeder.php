<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PackSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Pack::factory(10)->create();
    }
}
