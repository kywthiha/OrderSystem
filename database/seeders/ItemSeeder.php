<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::query()->isAdmin()->first();
        $categories = Category::query()->take(10)->with('subCategory:id,category_id')->select('id')->get();
        foreach ($categories as $category) {
            Item::factory([
                "created_user" => $user->id
            ])->for($category)->for($category->subCategory->shuffle()->first())->create();
        }
    }
}
