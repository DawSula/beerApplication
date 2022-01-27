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

//Route::resource('beers','BeerController');

Route::group(['middleware' => ['auth']], function () {

    Route::group(['prefix' => 'me', 'as' => 'me.', 'namespace' => 'UserBeers'], function () {
        Route::get('profile', 'UserController@profile')->name('profile');

        Route::get('edit', 'UserController@edit')->name('edit');

        Route::post('update', 'UserController@update')->name('update');


        Route::get('beers', 'BeerController@list')->name('favourite.list');

        Route::post('beers', 'BeerController@add')->name('favourite.add');

        Route::delete('beers', 'BeerController@remove')->name('favourite.remove');

        Route::post('beers/rate', 'BeerController@rate')->name('favourite.rate');
    });


    Route::group([ 'namespace' => 'Admin', 'middleware' => 'can:admin'], function () {
        Route::group(['as' => 'admin.users.','prefix' => 'user'], function () {

            Route::get('/', 'UserController@list')->name('users');
            Route::get('{userId}', 'UserController@show')->name('show');
        });

        Route::group(['as' => 'admin.waitingBeers','prefix'=>'waitingBeers'],function (){

           Route::get('/', 'WaitingBeerController@list')->name('beers');
           Route::delete('/','WaitingBeerController@delete')->name('delete');
           Route::put('/','WaitingBeerController@show')->name('add');
        });

    });

    Route::group([
        'prefix' => 'beers',
        'namespace' => 'Beers',
        'as' => 'beers.'
    ], function () {
        Route::get('dashboard', 'BeerController@dashboard')
            ->name('dashboard');

        Route::get('/', 'BeerController@list')->name('list');

        Route::get('add', 'BeerController@add')->name('add');

        Route::post('addBeer', 'BeerController@addBeer')->name('addBeer');

        Route::get('{beer}', 'BeerController@show')->name('show');

        Route::get('edit/{beer}', 'BeerController@edit')->name('edit');

        Route::post('update', 'BeerController@update')->name('update');

        Route::post('delete', 'BeerController@delete')->name('delete');


    });


    Route::get('/', 'Beers\BeerController@index');


});


Auth::routes();


