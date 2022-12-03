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
        $permissions = Permission::query()->select('id', 'name')->get();
        $role = Role::query()->create([
            'name' => 'admin',
        ]);
        $role->permissions()->attach($permissions->pluck('id'));

        $role = Role::query()->create([
            'name' => 'standard',
        ]);
        $role->permissions()->attach($permissions->whereIn('name', ['manage_items', 'manage_categories', 'manage_subcategories', 'manage_orders'])->pluck('id'));
    }
}
