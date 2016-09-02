<?php

namespace PatrickRose\Providers;

use Illuminate\Support\ServiceProvider;
use PatrickRose\Validation\BlogValidator;
use PatrickRose\Repositories\DbBlogRepository;
use PatrickRose\Repositories\DbTagRepository;
use PatrickRose\Repositories\DbGigRepository;

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
        $this->app->bind("PatrickRose\\Repositories\\TagRepositoryInterface", DbTagRepository::class);
    }

    private function registerGigRepository()
    {
        $this->app->bind("PatrickRose\\Repositories\\GigRepositoryInterface", function () {
            return new DbGigRepository();
        });
    }
}
