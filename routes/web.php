<?php

declare(strict_types=1);

use App\Http\Middleware\PageCheck;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::group(['middleware' => ['auth']], function () {

    Route::group(['prefix' => 'me', 'as' => 'me.', 'namespace' => 'UserBeers'], function () {

        Route::get('profile', 'UserController@profile')->name('profile');

        Route::get('edit', 'UserController@edit')->name('edit');

        Route::get('beers', 'BeerController@list')->name('favourite.list');

        Route::post('update', 'UserController@update')->name('update');

        Route::post('rate','UserBeerRateController@addRate')->name('rate');

        Route::post('beers', 'BeerController@add')->name('favourite.add');

        Route::delete('beers', 'BeerController@remove')->name('favourite.remove');


    });


    Route::group([ 'namespace' => 'Admin', 'middleware' => 'can:admin'], function () {

        Route::group(['as' => 'admin.users.','prefix' => 'user'], function () {

            Route::get('/', 'UserController@list')->name('users');

            Route::get('{userId}', 'UserController@show')->name('show');

        });

        Route::group(['as' => 'admin.waitingBeers.','prefix'=>'waitingBeers'],function (){

           Route::get('/', 'BeerController@list')->name('list');

           Route::put('/','BeerController@approve')->name('approve');

        });

    });

    Route::group([
        'prefix' => 'beers',
        'namespace' => 'Beers',
        'as' => 'beers.'
    ], function () {

        Route::get('/', 'BeerController@list')->name('list');

        Route::get('add', 'BeerController@add')->name('add');

        Route::get('{beer}', 'BeerController@show')->name('show');

        Route::get('edit/{beer}', 'BeerController@edit')->name('edit')->middleware('can:admin');

        Route::put('update', 'BeerController@update')->name('update');

        Route::post('addBeer', 'BeerController@addBeer')->name('addBeer');

        Route::delete('delete', 'BeerController@delete')->name('delete');

    });

    Route::get('/', 'Beers\BeerController@list');

});


Auth::routes();


