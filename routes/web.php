<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\searchController;

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

Route::middleware('auth')->get('/', function () {
    return view('home',['results'=>['images'=>[], 'count'=>'','offset'=>'']]);
})->name('home');

Route::post('/', [searchController::class, 'searchGif' ])->name('search-text');
Route::post('/search-ajax', [searchController::class, 'searchGifAjax'])->name('search-text-ajax');
route::post('/aearch-text-autocomplete', [searchController::class,'getAutocomplete'])->name('getAutocomplete');
