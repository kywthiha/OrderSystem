<?php

namespace App\Providers;


use App\Interfaces\AdminRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\ItemRepositoryInterface;
use App\Interfaces\OrderRepositoryInterface;
use App\Interfaces\RoleRepositoryInterface;
use App\Interfaces\SubCategoryRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\AdminRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ItemRepository;
use App\Repositories\OrderRepository;
use App\Repositories\RoleRepository;
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

        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);

        $this->app->bind(SubCategoryRepositoryInterface::class, SubCategoryRepository::class);

        $this->app->bind(ItemRepositoryInterface::class, ItemRepository::class);

        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);

        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);

        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
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
