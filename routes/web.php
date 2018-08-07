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

Route::group(['middleware' => 'auth'], function () {
    Route::resources([
        'reviews' => 'ReviewsController',
        'profile' => 'ProfileController',
    ]);
    Route::post('comment/store', 'CommentsController@store')->name('comment.add');
    Route::post('reply/store', 'CommentsController@replyStore')->name('reply.add');
});

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
    Route::get('/', 'PagesController@home');
    Route::resource('genres', 'GenreController')->except(['show']);
    Route::resource('actors', 'ActorController')->except(['show']);
    Route::resource('movies', 'MovieController')->except(['show']);
});

Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'LanguageController@switchLang']);
Route::get('login/facebook', 'Auth\LoginController@redirectToFacebook')->name('login.facebook');
Route::get('login/facebook/callback', 'Auth\LoginController@getFacebookCallback');
Route::get('/like/{id}', 'ReviewsController@like')->name('like');
