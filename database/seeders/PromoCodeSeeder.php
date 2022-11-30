<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PromoCodeSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\PromoCode::factory(5)->create();
    }
}
