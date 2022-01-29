<?php

namespace App\Http\Controllers\UserBeers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RateBeer;
use App\Repository\BeerRepositoryInterface;
use App\Repository\Eloquent\RateRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserBeerRateController extends Controller
{
    private BeerRepositoryInterface $beerRepository;
    private RateRepository $rateRepository;


    public function __construct(BeerRepositoryInterface $beerRepository, RateRepository $rateRepository)
    {
        $this->beerRepository = $beerRepository;
        $this->rateRepository = $rateRepository;
    }

    /**
     * @param BeerRepositoryInterface $beerRepository
     */


    public function addRate(RateBeer $request){



        $data = $request->validated();
        $beerId = (int) $data['beerId'];
        $rate = $data['rate'];
        $beer = $this->beerRepository->get($beerId);
        $user = Auth::user();
        if ($user->hasBeerRate($beerId)){
            $user->updateRate($beer, $rate);
            return redirect()
                ->route('beers.list');
        }
        else{
            $user->rateBeer($beer, $rate);
            $this->rateRepository->addRate($beerId,$rate);
            return redirect()
                ->route('beers.list');
        }



    }

}
