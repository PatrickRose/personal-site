<?php namespace PatrickRose\Services;
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 09/06/14
 * Time: 18:17
 */

use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind("PatrickRose\\Services\\BasketService", function() {
                return $this->app->make("PatrickRose\\Services\\SessionBasket");
            });
    }
}