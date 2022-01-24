<?php

declare(strict_types=1);

namespace App\Facade;

use App\Repository\BeerRepositoryInterface;
use Illuminate\Support\Facades\Facade;

class Beer extends Facade
{
    protected static function getFacadeAccessor()
    {
        return BeerRepositoryInterface::class;
    }
}
