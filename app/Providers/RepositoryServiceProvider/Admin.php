<?php

namespace App\Providers\RepositoryServiceProvider;

use Illuminate\Support\ServiceProvider;

class Admin extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\Admin\CategoryRepository::class, \App\Repositories\Admin\CategoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Admin\SubCategoryRepository::class, \App\Repositories\Admin\SubCategoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Admin\ProductRepository::class, \App\Repositories\Admin\ProductRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Admin\CustomerRepository::class, \App\Repositories\Admin\CustomerRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Admin\OrderRepository::class, \App\Repositories\Admin\OrderRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Admin\CountryRepository::class, \App\Repositories\Admin\CountryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Admin\CityRepository::class, \App\Repositories\Admin\CityRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Admin\FilterRepository::class, \App\Repositories\Admin\FilterRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Admin\SubFilterRepository::class, \App\Repositories\Admin\SubFilterRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Admin\SubscribeRepository::class, \App\Repositories\Admin\SubscribeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Admin\DeliveryRepository::class, \App\Repositories\Admin\DeliveryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Admin\ContactRepository::class, \App\Repositories\Admin\ContactRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Admin\SiteRepository::class, \App\Repositories\Admin\SiteRepositoryEloquent::class);
        //:end-bindings:
    }
}
