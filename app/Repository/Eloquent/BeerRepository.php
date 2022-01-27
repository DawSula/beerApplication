<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Model\Beer;
use App\Repository\BeerRepositoryInterface;
use Carbon\Carbon;


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

    public function makeBeer($data)
    {

        $path = $this->saveImage($data);

        $newBeer = new Beer([
            'name'=>$data['name'],
            'description'=>$data['description'],
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
            'id_style'=>$data['style'],
            'image'=>$path ?? null,
        ]);
       $newBeer->save();
    }

    public function deleteBeer(int $id){

        return  $this->beerModel->find($id)->delete();

    }
    public function updateBeer(Beer $beer, array $data)
    {

        $path = $this->saveImage($data);

//        if ($path) {
//            Storage::disk('s3')->delete($beer->avatar);
//            $data['avatar'] = $path;
//        }

        $beer->name = $data['name'];
        $beer->description = $data['description'];
        $beer->updated_at = Carbon::now();
        $beer->id_style = $data['style'];
        $beer->image = $path ?? null;

        $beer->save();

    }

    private function saveImage (array $data)
    {
        $image = $data['image'] ?? null;
        if (!empty($image)){
            $path = $data['image']->store('images','s3');
        }


        return $path ?? null;
    }


}
