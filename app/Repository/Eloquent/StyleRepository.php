<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Model\BeerStyle;

class StyleRepository
{

    private BeerStyle $beerStyle;

    /**
     * @param BeerStyle $beerStyle
     */
    public function __construct(BeerStyle $beerStyle)
    {
        $this->beerStyle = $beerStyle;
    }

    public function all(){
        return $this->beerStyle->get();

    }

}
