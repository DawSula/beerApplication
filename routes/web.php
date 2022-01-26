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

Route::group(['middleware'=>['auth']], function (){

    Route::group(['prefix'=>'me', 'as'=>'me.','namespace'=>'User'], function (){
       Route::get('profile','UserController@profile')->name('profile');

       Route::get('edit', 'UserController@edit')->name('edit');

       Route::post('update', 'UserController@update')->name('update');


       Route::get('beers', 'BeerController@list')->name('favourite.list');

       Route::post('beers', 'BeerController@add')->name('favourite.add');

       Route::delete('beers', 'BeerController@remove')->name('favourite.remove');

       Route::post('beers/rate', 'BeerController@rate')->name('favourite.rate');


    });


    Route::group([
        'prefix' => 'beers',
        'namespace' => 'Beers',
        'as'=>'beers.'
    ], function () {
        Route::get('dashboard', 'BeerController@dashboard')
            ->name('dashboard');

        Route::get('/', 'BeerController@index')->name('list');

        Route::get('add', 'BeerController@add')->name('add');

        Route::post('addBeer', 'BeerController@addBeer')->name('addBeer');

        Route::get('{beer}', 'BeerController@show')->name('show');

        Route::get('edit/{beer}','BeerController@edit')->name('edit');

        Route::post('update', 'BeerController@update')->name('update');

        Route::post('/', 'BeerController@delete')->name('delete');

    });


    Route::get('/', 'Beers\BeerController@index');


});


Auth::routes();


