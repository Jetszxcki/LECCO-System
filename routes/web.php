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

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('users', 'UsersController@index')->name('users.index')->middleware('auth');
Route::get('users/show_rights/{user}', 'UsersController@show_rights')->name('users.show_rights')->middleware('auth');
Route::patch('users/update_rights/{user}', 'UsersController@update_rights')->name('users.update_rights')->middleware('auth');
Route::delete('users/{user}', 'UsersController@destroy')->name('users.destroy')->middleware('auth');

Route::resource('members', 'MembersController')->names(['name' => ['index' => 'members.index']])->middleware('auth');
Route::resource('signatories', 'SignatoriesController')->names(['name' => ['index' => 'signatories.index']])->middleware('auth');
Route::resource('loan_types', 'LoanTypesController')->names(['name' => 'loan_types.index'])->middleware('auth');
Route::resource('loans', 'LoansController')->names(['name' => 'loans.index'])->middleware('auth');

Route::get('shares', 'SharesController@index')->name('shares.index')->middleware('auth');
Route::get('shares/create', 'SharesController@create')->name('shares.create')->middleware('auth');
Route::post('shares', 'SharesController@store')->name('shares.store')->middleware('auth');
Route::get('shares/{share}', 'SharesController@show')->name('shares.show')->middleware('auth');

Route::get('loans', 'LoansController@index')->name('loans.index')->middleware('auth');
Route::get('loans/create', 'LoansController@create')->name('loans.create')->middleware('auth');
Route::post('loans', 'LoansController@store')->name('loans.store')->middleware('auth');

