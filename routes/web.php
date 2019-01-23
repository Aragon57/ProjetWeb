<?php

use App\Http\Controllers\ProductController;

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

Route::get('/boutique', 'ProductController@display' ,function () {
    return view('boutique');
});

Route::get('/connexion', function () {
    return view('connexion');
});


Route::get('/idee',  'IdeeController@display',  function () {
    return view('idee');
});

Route::get('/inscription', function () {
    return view('inscription');
});

Route::get('/cart', function () {
    return view('cart');
});


Route::get('/event' , 'EventController@display', function () {
    return view('event');
});

Route::get('/usernav', function () {
    return view('layouts/usernav');
});

Route::post('/image', 'ImageController@store');

Route::post('/comment', 'CommentController@store');

Route::post('/like', 'LikeController@store');


Route::post('/inscription', 'UsersController@store');
Route::post('/connexion', 'UsersController@connect');
Route::get('/logout', 'UsersController@logout');
Route::post('/idee', 'IdeeController@store');
Route::put('/idee/{id}', 'IdeeController@change');
Route::post('/event', 'EventController@store');


Route::post('/eventregister', 'EventRegisterController@store');


Route::post('/inscription', 'UsersController@store');

Route::get('/footer', function () {
    return view('footer');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/evenementdumois', function () {
    return view('evenementdumois');
});

Route::get('/islogged', 'UsersController@isLogged');

Route::get('/fetchcart', 'CartController@cart');

Route::post('/article', 'ProductController@addarticle');

