<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BeerStyle extends Model
{
    protected $table = 'beer_style';

    public function beers()
    {
        return $this->hasMany(
            Beer::class, 'id_style',);
    }
}
