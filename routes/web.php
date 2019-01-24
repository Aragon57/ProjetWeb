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


Route::get('/cartview', function () {
    return view('layouts/cartview');
});

Route::post('/image', 'ImageController@store');

Route::post('/image', 'EventController@storeImage');


Route::post('/comment', 'EventController@storeComment');
Route::post('/commentImage', 'EventController@storeCommentImage');
Route::post('/event/downloadPic', 'EventController@downloadPic');

Route::post('/like', 'LikeController@store');

Route::post('/validate', 'IdeeController@update');

Route::post('/inscription', 'UsersController@store');
Route::post('/connexion', 'UsersController@connect');
Route::get('/logout', 'UsersController@logout');
Route::post('/idee', 'IdeeController@store');
Route::put('/idee/{id}', 'IdeeController@update');
Route::post('/event', 'EventController@store');
Route::post('/image/delete', 'EventController@deleteImage');

Route::post('/comment/delete', 'EventController@deleteComment');



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

Route::get('/cart', 'CommandController@show', function() {
    return view('cart');
});

Route::get('/islogged', 'UsersController@isLogged');

Route::get('/fetchcart', 'CartController@cart');

Route::post('/article', 'ProductController@addarticle');


Route::delete('product/{id}/delete', 'ProductController@delete');

Route::post('/tocart', 'CommandController@addarticle');
Route::post('/showcart', 'CommandController@show');
Route::delete('/product', 'CommandController@deleteproduct');
Route::post('/product', 'ProductController@getProduct');
Route::put('/product', 'CommandController@updatequantity');