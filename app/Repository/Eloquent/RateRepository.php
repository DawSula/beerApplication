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


    public function removeOldRate(int $rateId, int $rate)
    {
        $beerRate = $this->beerRate->where('rate_id','=', $rateId)->where('rate', '=', $rate)->first();
        $beerRate->delete();
    }



}
