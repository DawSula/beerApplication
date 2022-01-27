<?php

declare(strict_types=1);

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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

    public function addBeer(Beer $beer):void
    {
        $this->beers()->save($beer);
    }

    public function hasBeer(int $beerid)
    {
        $beer = $this->beers()->where('userBeers.beer_id', $beerid)->first();

        return (bool) $beer;
    }
    public function removeBeer(Beer $beer)
    {
        $this->beers()->detach($beer->id);
    }
    public function isAdmin():bool
    {
        return (bool) $this->admin;
    }
}
