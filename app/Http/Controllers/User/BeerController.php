<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Http\Requests\AddBeerToUserList;
use App\Repository\BeerRepositoryInterface;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BeerController extends Controller
{

    private BeerRepositoryInterface $beerRepository;

    /**
     * @param BeerRepositoryInterface $beerRepository
     */
    public function __construct(BeerRepositoryInterface $beerRepository)
    {
        $this->beerRepository = $beerRepository;
    }

    public function list(){
        dd('hello');
    }

    public function add(Request $request)
    {
        $beerId = (int) $request->get('gameId');


        $beer = $this->beerRepository->get($beerId);

        $user = Auth::user();
        $user->addBeer($beer);

        return redirect()
            ->route('beers.show', ['beer'=>$beerId])
            ->with('success', 'Gra została dodana');

    }
    public function remove(){
        dd('hello');
    }

    public function rate(){
        dd('hello');
    }


}
