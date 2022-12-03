<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::query()->select('id', 'name')->get();
        $user = User::query()->create([
            'name' => 'Admin',
            'email' => 'admin@kyawthiha.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);
        $user->roles()->attach([$roles->first()->id]);
        $user = User::query()->create([
            'name' => 'standard',
            'email' => 'standard@kyawthiha.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);
        $user->roles()->attach([$roles->last()->id]);
    }
}
