<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\{Auth, Route};

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

Auth::routes();

Route::group(['middleware'=>'auth'], function (){
    Route::redirect('/home   ', '/filmes');
    Route::redirect('/   ', '/filmes');

    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::put('/profile', 'ProfileController@update')->name('profile.update');

    Route::post('filmes/datatable', [MovieController::class, 'datatable'])->name('movies.datatable');
    Route::post('filmes/search', [MovieController::class, 'search'])->name('movies.search');
    Route::get('filmes/list', [MovieController::class, 'listMovies'])->name('movies.list');
    Route::get('filmes/create/{idtmdb}', [MovieController::class, 'create'])->name('movies.create');
    Route::resource('filmes', 'MovieController')->names('movies')->parameters(['filmes' => 'movies'])->except('create');
});

