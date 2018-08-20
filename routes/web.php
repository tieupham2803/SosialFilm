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

Route::get('/', 'PagesController@welcome');
Route::get('/loadMore', 'PagesController@ajaxLoadMore');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('profile', 'ProfileController');
    Route::resource('reviews', 'ReviewsController', ['except' => ['show']]);
    Route::post('comment/store', 'CommentsController@store')->name('comment.add');
    Route::post('reply/store', 'CommentsController@replyStore')->name('reply.add');
    Route::post('notification/fetch_noti_count', 'NotificationsController@fetch_noti_count')
        ->name('notification.fetch_noti_count');
    Route::post('notification/fetch_noti_list', 'NotificationsController@fetch_noti_list')
        ->name('notification.fetch_noti_list');
    Route::get('reviews/createId/{id}', 'ReviewsController@createId')->name('reviews.createId');
});
Route::get('reviews/{review}', 'ReviewsController@show')->name('reviews.show');
Route::post('comment/fetch', 'CommentsController@fetch')->name('comment.fetch');
Route::post('comment/fetch2', 'CommentsController@fetch2')->name('comment.fetch2');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'locale'], function () {
    Route::get('change-language/{language}', 'HomeController@changeLanguage')
        ->name('user.change-language');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('users', ['as' => 'admin.user.index', 'uses' => 'UsersController@index']);
    Route::get('roles', 'RolesController@index')->name('roles.index');
    Route::get('roles/create', 'RolesController@create');
    Route::post('roles/create', 'RolesController@store');
    Route::get('users/{id?}/edit', 'UsersController@edit');
    Route::post('users/{id?}/edit', 'UsersController@update');
    Route::get('/', 'PagesController@adminIndex');
    Route::get('/wc', 'PagesController@welcome');

    Route::resource('genres', 'GenreController')->except(['show']);
    Route::resource('actors', 'ActorController');
    Route::resource('movies', 'MovieController');
    Route::resource('review', 'ReviewsController')->except(['show', 'store', 'update', 'create', 'edit']);
});

Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'LanguageController@switchLang']);
Route::get('login/facebook', 'Auth\LoginController@redirectToFacebook')->name('login.facebook');
Route::get('login/facebook/callback', 'Auth\LoginController@getFacebookCallback');
Route::get('/like/{id}', 'ReviewsController@like')->name('like');
Route::resource('moviedetails', 'MovieDetailController');
Route::get('/search/name', 'ReviewsController@searchByName');
Route::get('/search/movie', 'MovieDetailController@searchByName');
// Route::post('moviedetails/search', 'MoviedetailController@search')->name('moviedetails.search');
Route::post('moviefilter/search', 'MovieFilterController@search')->name('moviefilter.search');
