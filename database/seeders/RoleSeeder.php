<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        $role = Role::query()->create([
            'name' => 'admin',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        $role->permissions()->attach(Permission::query()->pluck('id'));
    }
}
