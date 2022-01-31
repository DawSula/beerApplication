<?php

declare (strict_types=1);

namespace App\Http\Controllers\Beers;

use App\Facade\Beer;
use App\Http\Controllers\Controller;
use App\Http\Requests\MakeBeer;
use App\Http\Requests\UpdateBeer;
use App\Model\BeerStyle;
use App\Repository\BeerRepositoryInterface;
use App\Repository\Eloquent\RateRepository;
use App\Repository\Eloquent\StyleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;
use function view;

class BeerController extends Controller
{

    private BeerRepositoryInterface $beerRepository;
    private StyleRepository $styleRepository;
    private RateRepository $rateRepository;


    public function __construct(BeerRepositoryInterface $beerRepository, StyleRepository $styleRepository, RateRepository $rateRepository)
    {
        $this->beerRepository = $beerRepository;
        $this->styleRepository = $styleRepository;
        $this->rateRepository = $rateRepository;
    }


    public function list(Request $request): View
    {

        $phrase = $request->get('phrase');
        $style = $request->get('style', 'all');


        $resultPaginator = $this->beerRepository->approvedFilterBy($phrase, $style, 9);
        $resultPaginator->appends([
            'phrase' => $phrase,
            'style' => $style,
        ]);


        return view('beers.list',
            [
//                'beers' => $this->beerRepository->allPaginated(12),
                'beers' => $resultPaginator,
                'phrase' => $phrase,
                'style' => $style,
                'allStyles' => $this->styleRepository->all(),

            ]);
    }

    public function show(int $beerId, Request $request)
    {

        $user = Auth::user();
        $userHasBeer = $user->hasBeer($beerId);





        return view('beers.beer', [
            'beer' => $this->beerRepository->getWithAvgScore($beerId),
            'userHasBeer'=>$userHasBeer,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function add()
    {


        return view('beers.add',['allStyles' => $this->styleRepository->all(),]);
    }

    public function addBeer(MakeBeer $request){
        $data = $request->validated();

        $this->beerRepository->makeBeer($data);

        return redirect()
            ->route('beers.list')
            ->with('success', 'Piwo zostało dodane');
    }

    public function edit(int $id)
    {
        {
            $beer = $this->beerRepository->get($id);


            return view('beers.edit', ['beer'=>$beer, 'allStyles' => $this->styleRepository->all(),]);
        }
    }

    public function update(UpdateBeer $request)
    {
        $data = $request->validated();
        $beer = $this->beerRepository->get((int) $data['beerId']);


        $this->beerRepository->updateBeer($beer, $data);

        return redirect()
            ->route('beers.list')
            ->with('success','Piwo zostało zaktualizowane');

    }


    public function delete(Request $request){



        $beerId = (int) $request->get('beerId');
        $beer = $this->beerRepository->get($beerId);
        $user = Auth::user();
        $user->removeBeers($beer);
        $this->beerRepository->deleteBeer($beerId);

        return redirect()
            ->route('beers.list')
            ->with('success', 'Piwo zostało usunięte');


    }






}
