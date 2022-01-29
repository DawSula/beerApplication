<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\BeerRepositoryInterface;
use Illuminate\Http\Request;

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

    public function list (){

        $beers = $this->beerRepository->unapprovedPaginated(9);

        return view('admin.beers.list',['beers'=>$beers]);
    }

    public function approve(Request $request){

        $beerId = (int) $request->get('beerId');
        $this->beerRepository->approve($beerId);

        return redirect()
            ->route('admin.waitingBeers.list')
            ->with('success', 'Dodano do głównej listy');
    }

}
