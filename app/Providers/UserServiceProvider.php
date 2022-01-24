<?php

declare(strict_types=1);

namespace App\Providers;

use App\Model\User;
use App\Repository\Eloquent\UserRepository;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class
        );
    }


    public function boot()
    {
        //
    }

}
