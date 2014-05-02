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
        $this->registerTagRepository();
        $this->registerGigRepository();
    }

    public function registerBlogRepository()
    {
        $this->app->bind("PatrickRose\\Repositories\\BlogRepositoryInterface", function () {
            return new DbBlogRepository();
        });
    }

    private function registerTagRepository()
    {
        $this->app->bind("PatrickRose\\Repositories\\TagRepositoryInterface", function () {
            return new DbTagRepository();
        });
    }

    private function registerGigRepository()
    {
        $this->app->bind("PatrickRose\\Repositories\\GigRepositoryInterface", function() {
           return new StaticGigRepository();
        });
    }
}