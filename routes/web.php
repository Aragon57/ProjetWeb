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

Route::get('/nav', function (){
    return view('layouts/nav');
});

Route::get('/admin', function () {
    return view('admin/datatable');
});

Route::get('/data', 'AdminController@getusers');
Route::post('/data', 'AdminController@getusers');

Route::get('/data/event', 'AdminController@getevent');
Route::post('/data/event', 'AdminController@getevent');

Route::get('/data/command', 'AdminController@getcommand');
Route::post('/data/command', 'AdminController@getcommand');

Route::get('/data/article', 'AdminController@getarticle');
Route::post('/data/article', 'AdminController@getarticle');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/inscription', function () {
    return view('inscription');
});

Route::get('/connexion', function () {
    return view('connexion');
});


Route::get('/event' , 'EventController@store', function () {
    return view('event');
});


Route::get('/idee',  'IdeeController@display',  function () {
    return view('idee');
});

Route::get('/boutique', 'ProductController@display', function () {
    return view('boutique');
});


Route::get('user/{id}', function($id)
{
    return 'User '.$id;
});

Route::get('/cart', function () {
    return view('cart');
});


Route::get('/politique', function () {
    return view('politique');
});

Route::get('/mentions', function () {
    return view('mentions');
});

Route::get('/conditions', function () {
    return view('conditions');
});

Route::get('/credits', function () {
    return view('credits');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/cart', 'CommandController@show', function() {
    return view('cart');
});

Route::get('/footer', function () {
    return view('footer');
});

Route::get('generate-pdf/{id}','EventIdController@generatePDF');

Route::get('/event' , 'EventController@display', function () {
    return view('event');
});

Route::get('/event/{id}' , 'EventIdController@display', function () {
    return view('eventId');
});

Route::get('/usernav', function () {
    return view('layouts/usernav');

});

Route::get('/idee',  'IdeeController@display',  function () {
    return view('idee');
});

Route::get('/cartview', function () {
    return view('layouts/cartview');
});


Route::get('/articlenon', function () {
    return view('layouts/articlenon');
});

Route::get('/usernav', function () {
    return view('layouts/usernav');
});

Route::get('/administration', function () {
    return view('administration');
});


Route::get('/validationCommand', 'CommandController@validateCommand');

Route::post('/image', 'ImageController@store');

Route::post('/add/image/{id}', 'EventController@storeImage');


Route::get('/dlfile', 'EventController@get_file');

Route::post('/validatecommand', 'CommandController@validateCommand');


Route::get('/voteidee/{id}', 'LikeController@storeVote');


Route::get('/article', function () {
    return view('layouts/article');
});

Route::get('/modal', function () {
    return view('modal');
});

Route::get('/evenementdumois', function () {
    return view('evenementdumois');
});

Route::get('/shopcomp', function () {
    return view('components/shopcomp');
});

Route::get('/articlecard', function () {
    return view('components/articlecard');
});

Route::delete('/product', 'CommandController@deleteproduct');
Route::post('/product', 'ProductController@getProduct');
Route::put('/product', 'CommandController@updatequantity');
Route::post('/showcart', 'CommandController@show');
Route::get('/islogged', 'UsersController@isLogged');
Route::get('/fetchcart', 'CartController@cart');
Route::post('/article', 'ProductController@addarticle');
Route::post('/tocart', 'CommandController@addarticle');
Route::post('/product/destroy', 'ProductController@destroy');
Route::post('/comment', 'EventController@storeComment');
Route::post('/commentImage', 'EventController@storeCommentImage');
Route::post('/event/downloadPic', 'EventController@downloadPic');

Route::post('/like', 'LikeController@store');
Route::post('/validate', 'IdeeController@update');


Route::post('/likepic/{id}', 'LikeController@store');
Route::get('/register/{id}', 'LikeController@storeRegister');

Route::post('/validate', 'IdeeController@update');

Route::post('/image/report/{id}', 'EventController@reportImage');

Route::get('/event/report/{id}', 'EventController@reportEvent');


Route::post('/comment/report/{id}', 'EventController@reportComment');


Route::post('/inscription', 'UsersController@store');
Route::post('/connexion', 'UsersController@connect');
Route::get('/logout', 'UsersController@logout');
Route::post('/idee', 'IdeeController@store');
Route::put('/idee/{id}', 'IdeeController@update');
Route::post('/event', 'EventController@store');


Route::post('/image/delete/{id}', 'EventController@deleteImage');


Route::post('/comment/delete', 'EventController@deleteComment');
Route::post('/category', 'CategoryController@store');
Route::post('/inscription', 'UsersController@store');
Route::post('/image', 'ImageController@store');
Route::post('/image', 'EventController@storeImage');
Route::post ('/search', 'ProductController@searchby');