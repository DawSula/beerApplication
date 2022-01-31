<?php

declare(strict_types=1);

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar','admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function beers()
    {
        return $this->belongsToMany(Beer::class, 'userBeers');
    }

    public function beersRate()
    {
        return $this->belongsToMany(Beer::class,'user_rates')
            ->withPivot('rate');
    }

    public function addBeer(Beer $beer):void
    {
        $this->beers()->save($beer);
    }

    private function addRate(Beer $beer){
        $this->beersRate()->save($beer);
    }

    public function hasBeer(int $beerid)
    {
        $beer = $this->beers()->where('userBeers.beer_id', $beerid)->first();

        return (bool) $beer;
    }
    public function hasBeerRate(int $beerid)
    {
        $beer = $this->beersRate()->where('user_rates.beer_id', $beerid)->first();

        return (bool) $beer;
    }

    public function removeBeer(Beer $beer, $userId)
    {
        $this->beers()->where('user_id',$userId)->detach($beer->id);
    }
    public function removeBeers(Beer $beer)
    {
        $this->beers()->detach($beer->id);
    }

    public function isAdmin():bool
    {
        return (bool) $this->admin;
    }
    public function rateBeer(Beer $beer, $rate)
    {
        $this->addRate($beer);
        $this->beersRate()->updateExistingPivot($beer, ['rate'=>$rate]);
    }

    public function updateRate(Beer $beer, $rate)
    {
        $this->beersRate()->updateExistingPivot($beer, ['rate'=>$rate]);
    }
    public function findOldRate($beerId, $userId)
    {
        $db = DB::table('user_rates')->where('user_id',$userId)->where('beer_id',$beerId)->first('rate');
        return (int) $db->rate;
    }
}
