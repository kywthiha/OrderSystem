<?php

namespace Database\Seeders;

use App\Models\Permission;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        $permissions = [
            [
                'name' => 'manage_users',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'manage_orders',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'manage_items',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'manage_categories',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'manage_subcategories',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'manage_admins',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ];
        Permission::query()->insert($permissions);
    }
}
