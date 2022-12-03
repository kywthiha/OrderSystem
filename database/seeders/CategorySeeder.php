<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::query()->isAdmin()->first();
        Category::factory([
            "created_user" => $user->id
            ])
            ->has(SubCategory::factory(["created_user" => $user->id])->count(2))
            ->count(10)
            ->create();
    }
}
