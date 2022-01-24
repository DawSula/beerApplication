<?php

namespace App\Model;

use App\Model\Scope\LastWeekScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
    protected static function booted()
    {
        static::addGlobalScope(new LastWeekScope());
    }

    protected $fillable = [
        'name','description','score','id_style','image'
    ];

    public function beerStyle()
    {

        return $this->belongsTo(BeerStyle::class, 'id_style');
    }

    // scope

    public function scopeBest(Builder $query): Builder
    {

        return $query
            ->with('beerStyle')
            ->where('score', '>', 4);
    }

    public function scopeStyle(Builder $query, int $beerId): Builder
    {
        return $query->where('id_style', $beerId);
    }


}
