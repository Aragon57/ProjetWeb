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


Route::get('/idee', function () {
    return view('idee');
});

Route::get('/inscription', function () {
    return view('inscription');
});

Route::post('/inscription', 'UsersController@store');
Route::post('/connexion', 'UsersController@connect');
Route::get('/logout', 'UsersController@logout');
Route::post('/idee', 'IdeeController@store');
