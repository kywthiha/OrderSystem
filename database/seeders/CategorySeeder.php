<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use App\Models\SubCategory;
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
        $category = Category::factory()
            ->has(SubCategory::factory()->count(1))
            ->create();

        Item::factory()
            ->count(30)
            ->for($category)
            ->for($category->subCategory->first())
            ->create();
    }
}
