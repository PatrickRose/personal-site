<?php namespace PatrickRose\Repositories;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Factory;
use PatrickRose\Validation\BlogValidator;

class BackendServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBlogRepository();
    }

    public function registerBlogRepository()
    {
        $this->app->bind("PatrickRose\\Repositories\\BlogRepositoryInterface", function () {
            return new DbBlogRepository();
        });
    }
}