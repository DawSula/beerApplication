<?php

namespace App\Providers;

use App\Model\Beer;
use App\Repository\BeerRepositoryInterface;
use App\Repository\Eloquent\BeerRepository as EloquentBeerRepository;
use App\Service\FakeService;
use Illuminate\Support\ServiceProvider;

class BeerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->bind(
//            BeerRepositoryInterface::class, EloquentBeerRepository::class
//        );

        $this->app->bind(BeerRepositoryInterface::class,
            function ($app) {


                return new EloquentBeerRepository(
//                new Beer()
                    $app->make(Beer::class),
                    $app->make(FakeService::class)
                );
            });
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
