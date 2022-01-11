<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//login
Route::post('login', 'Api\UserController@login')->name('login');
Route::post('register', 'Api\UserController@register')->name('register');
Route::post('profile', 'Api\UserController@profile')->name('profile');

// Barang
Route::get('barang', 'Api\BarangController@index')->name('barang');
Route::post('addbarang', 'Api\BarangController@add')->name('addbarang');
Route::post('claimbarang', 'Api\BarangController@claim')->name('claimbarang');



