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
        $user = User::query()->create([
            'name' => 'Admin',
            'email' => 'admin@kyawthiha.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);
        $user->roles()->attach(Role::query()->pluck('id'));
    }
}
