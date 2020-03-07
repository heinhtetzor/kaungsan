<?php

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

Route::get('/', function () {
    return view('home');
})->middleware('auth');

Auth::routes();

//search collaterals
Route::get('/collaterals/searchById', 'CollateralController@searchById')->name('collaterals.searchById')->middleware('auth');
Route::get('/collaterals/searchByCustomerName', 'CollateralController@searchByCustomerName')->name('collaterals.searchByCustomerName')->middleware('auth');

Route::resource('/collaterals', 'CollateralController')->middleware('auth');

Route::post('/collaterals/interests', 'CollateralController@addInterest')->name('collaterals.addInterest')->middleware('auth');
Route::delete('/collaterals/interests/{id}', 'CollateralController@destroyCollateralInterest')->name('collaterals.destroyCollateralInterest')->middleware('auth');
Route::put('/collaterals/withdrawCollateral/{id}', 'CollateralController@withdrawCollateral')->name('collaterals.withdrawCollateral')->middleware('auth');
