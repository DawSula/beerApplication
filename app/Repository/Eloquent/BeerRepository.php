<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Model\Beer;
use App\Repository\BeerRepositoryInterface;
use App\Service\FakeService;

class BeerRepository implements BeerRepositoryInterface
{
    private Beer $beerModel;

//    public function __construct(Beer $beerModel, FakeService $config)
    public function __construct(Beer $beerModel)
    {
        $this->beerModel=$beerModel;
    }

    public function get(int $beerId)
    {

        return $this->beerModel->find($beerId);
    }

    public function all()
    {
        return $this->beerModel
            ->with('beerStyle')
            ->get();
    }

    public function allPaginated(int $limit)
    {
        return $this->beerModel
            ->with('beerStyle')
            ->orderBy('beers.score', 'desc')
            ->paginate($limit);
    }

    public function best()
    {
        return $this->beerModel
            ->best()
            ->get();
    }

    public function stats()
    {
        return [
            'max' => $this->beerModel->max('score'),
            'min' => $this->beerModel->min('score'),
            'avg' => $this->beerModel->avg('score'),
            'count' => $this->beerModel->count(),
            'countScoresMoreThan4' => $this->beerModel->where('score', '>', '4')->count()
        ];
    }

    public function scoreStats()
    {
        return $this->beerModel->select
        ($this->beerModel->raw('count(*) as count'), 'score')
            // ->having('score', '>=' , 4)
            ->groupBy('score')
            ->orderByDesc('score')
            ->get();
    }

    public function filterBy(?string $phrase, $style, int $size)
    {



        $query = $this->beerModel
            ->with('beerStyle')
            ->orderBy('created_at');

        if ($phrase){
            $query->whereRaw('name like ?', ["$phrase%"]);
        }
        if ($style !== 'all'){
            $query->where('id_style',$style);
        }




        return $query->paginate($size);


    }


}
