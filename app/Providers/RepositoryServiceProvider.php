<?php

namespace App\Providers;

use App\Interfaces\ActivityLogRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\ItemRepositoryInterface;
use App\Interfaces\OrderRepositoryInterface;
use App\Interfaces\PackRepositoryInterface;
use App\Interfaces\PromoCodeRepositoryInterface;
use App\Interfaces\SubCategoryRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\ActivityLogRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ItemRepository;
use App\Repositories\OrderRepository;
use App\Repositories\PackRepository;
use App\Repositories\PromoCodeRepository;
use App\Repositories\SubCategoryRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

        $this->app->bind(PackRepositoryInterface::class, PackRepository::class);

        $this->app->bind(PromoCodeRepositoryInterface::class, PromoCodeRepository::class);

        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);

        $this->app->bind(ActivityLogRepositoryInterface::class, ActivityLogRepository::class);

        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);

        $this->app->bind(SubCategoryRepositoryInterface::class, SubCategoryRepository::class);

        $this->app->bind(ItemRepositoryInterface::class, ItemRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
