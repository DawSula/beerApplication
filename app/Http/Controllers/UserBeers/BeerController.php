<?php

declare(strict_types=1);

namespace App\Http\Controllers\UserBeers;

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


        $user = Auth::user();

        return view('me.list',[
            'beers'=>$user->beers()->paginate()
        ]);
    }

    public function add(AddBeerToUserList $request)
    {
        $beerId = $request->validated();

        $beerId = (int) $request->get('beerId');

        $beer = $this->beerRepository->get($beerId);

        $user = Auth::user();
        $user->addBeer($beer);

        return redirect()
            ->route('beers.show', ['beer'=>$beerId])
            ->with('success', 'Piwo zostało dodane');

    }
    public function remove(Request $request){
        $beerId = (int) $request->get('beerId');
        $beer = $this->beerRepository->get($beerId);

        $user = Auth::user();
        $user->removeBeer($beer);

        return redirect()
            ->route('beers.show', ['beer'=>$beerId])
            ->with('success', 'Piwo zostało usunięte');
    }

    public function rate(){
        dd('hello');
    }


}
