<?php

namespace App\Repository\Eloquent;

use App\Model\BeerRate;
use Carbon\Carbon;

class RateRepository
{
    private BeerRate $beerRate;

    /**
     * @param BeerRate $beerRate
     */
    public function __construct(BeerRate $beerRate)
    {
        $this->beerRate = $beerRate;
    }

    public function addRate(int $id, int $rate)
    {
        $beerRate = new BeerRate([
            'rate_id'=>$id,
            'rate'=>$rate,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ]);
        $beerRate->save();
    }
    public function showRates()
    {
        $query = $this->beerRate
            ->select($this->beerRate->raw('avg(rate) as rate','rate_id'))
            ->groupBy('rate_id')
            ->get();
        return $query;
    }

}
