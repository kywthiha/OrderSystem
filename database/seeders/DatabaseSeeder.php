<?php

namespace Database\Seeders;

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

        // $this->call([UserSeeder::class, PackSeeder::class, PromoCodeSeeder::class,CategorySeeder::class]);
        $this->call([PermissionSeeder::class,RoleSeeder::class,AdminSeeder::class]);
    }
}
