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
    return view('welcome');
});

Route::get('/boutique', function () {
    return view('boutique');
});

Route::get('/connexion', function () {
    return view('connexion');
});

Route::post('/inscription', 'UsersController@store');
Route::post('/connexion', 'UsersController@connect');