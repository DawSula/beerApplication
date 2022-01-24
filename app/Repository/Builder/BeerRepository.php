<?php

declare(strict_types=1);

namespace App\Repository\Builder;

use App\Model\Beer;
use App\Repository\BeerRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class BeerRepository implements BeerRepositoryInterface
{
    private Beer $beerModel;

    public function __construct(Beer $beerModel)
    {

    }

    public function get(int $beerId)
    {
        return DB::table('beers')->find($beerId);

    }

    public function all()
    {

    }

    public function allPaginated(int $limit)
    {
        $pageName = 'page';
        $currentPage = Paginator::resolveCurrentPage($pageName);

        $baseQuery = DB::table('beers')
            ->join('beer_style', 'beers.id_style', '=', 'beer_style.id');
        $total = $baseQuery->count();

        $data = collect();

        if ($total){
            $data = $baseQuery
                ->select(
                    'beers.id', 'beers.name', 'beers.description','beers.score',
                    'beer_style.name as style_name'
                )
                ->latest('beers.created_at')
                ->forPage($currentPage,$limit)
                ->get()
                ->map(fn($row)=>$this->createBeer($row));
        }


        return new LengthAwarePaginator(
            $data,
            $total,
            $limit,
            $currentPage,
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => $pageName
            ]
        );
    }

    public function best()
    {
        $data = DB::table('beers')
            ->join('beer_style', 'beers.id_style', '=', 'beer_style.id')
            ->select(
                'beers.id', 'beers.name', 'beers.description','beers.score',
                'beer_style.name as style_name'
            )
            ->where('beers.score', '>', 4)
            ->get()
            ->map(fn($row)=>$this->createBeer($row));

        return $data;
    }

    public function stats()
    {
        return [
            'max' => DB::table('beers')->max('score'),
            'min' => DB::table('beers')->min('score'),
            'avg' => DB::table('beers')->avg('score'),
            'count' => DB::table('beers')->count(),
            'countScoresMoreThan4' => DB::table('beers')->where('score', '>', '4')->count()
        ];
    }

    public function scoreStats()
    {
        return DB::table('beers')
            ->select(DB::raw('count(*) as count'),'score')
            // ->having('score', '>=' , 4)
            ->groupBy('score')
            ->orderByDesc('score')
            ->get();
    }


    private function createBeer(\stdClass $beer):\stdClass
    {
        $beerStyle = new \stdClass();
        $beerStyle->name = $beer->style_name;
        $beer->beerStyle = $beerStyle;

        unset($beer->style_name);

        return $beer;
    }
    public function filterBy(?string $phrase, string $type = 'beer', int $size = 12)
    {
        // TODO: Implement filterBy() method.
    }

}
