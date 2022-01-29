<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeerRate extends Model
{
    protected $table = 'beer_rates';
    protected $fillable = [
        'rate','rate_id'
    ];

//    public function beerRate()
//    {
//
//        return $this->belongsTo(Beer::class);
//    }

//SELECT beers.name, beers.id, avg(rate), beer_rates.rate_id FROM beers
//    left join beer_rates on beers.id = beer_rates.rate_id group by beers.id;



}
