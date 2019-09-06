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

Route::view('/', 'welcome');

Route::resource('members', 'MembersController')->names(['name' => ['index' => 'members.index']])->middleware('auth');
Route::resource('signatories', 'SignatoriesController')->names(['name' => ['index' => 'signatories.index']])->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
