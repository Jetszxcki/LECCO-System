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

Route::get('user/profile/{user}', 'UsersController@profile')->name('users.profile')->middleware('auth');
Route::patch('user/update_avatar/{user}', 'UsersController@update_avatar')->name('users.update_avatar')->middleware('auth');
Route::get('users', 'UsersController@index')->name('users.index')->middleware(['auth', 'accessRight:user_view']);
Route::get('users/show_rights/{user}', 'UsersController@show_rights')->name('users.show_rights')->middleware(['auth', 'accessRight:user_view']);
Route::patch('users/update_rights/{user}', 'UsersController@update_rights')->name('users.update_rights')->middleware(['auth', 'accessRight:invoke_rights']);
Route::delete('users/{user}', 'UsersController@destroy')->name('users.destroy')->middleware(['auth', 'accessRight:user_delete']);

Route::get('members', 'MembersController@index')->name('members.index')->middleware(['auth', 'accessRight:member_view']);
Route::get('members/create', 'MembersController@create')->name('members.create')->middleware(['auth', 'accessRight:member_create']);
Route::post('members', 'MembersController@store')->name('members.store')->middleware(['auth', 'accessRight:member_create']);
Route::get('members/{member}','MembersController@show')->name('members.show')->middleware(['auth', 'accessRight:member_view']);
Route::get('members/{member}/edit', 'MembersController@edit')->name('members.edit')->middleware(['auth', 'accessRight:member_edit']);
Route::patch('members/{member}', 'MembersController@update')->name('members.update')->middleware(['auth', 'accessRight:member_edit']);
Route::delete('members/{member}', 'MembersController@destroy')->name('members.destroy')->middleware(['auth', 'accessRight:member_delete']);

Route::get('signatories', 'SignatoriesController@index')->name('signatories.index')->middleware(['auth', 'accessRight:signatories_view']);
Route::get('signatories/create', 'SignatoriesController@create')->name('signatories.create')->middleware(['auth', 'accessRight:signatories_create']);
Route::post('signatories', 'SignatoriesController@store')->name('signatories.store')->middleware(['auth', 'accessRight:signatories_create']);
Route::get('signatories/{signatory}/edit', 'SignatoriesController@edit')->name('signatories.edit')->middleware(['auth', 'accessRight:signatories_edit']);
Route::patch('signatories/{signatory}', 'SignatoriesController@update')->name('signatories.update')->middleware(['auth', 'accessRight:signatories_edit']);
Route::delete('signatories/{signatory}', 'SignatoriesController@destroy')->name('signatories.destroy')->middleware(['auth', 'accessRight:signatories_delete']);

Route::get('loan_types', 'LoanTypesController@index')->name('loan_types.index')->middleware(['auth', 'accessRight:loan_types_view']);
Route::get('loan_types/create', 'LoanTypesController@create')->name('loan_types.create')->middleware(['auth', 'accessRight:loan_types_create']);
Route::post('loan_types', 'LoanTypesController@store')->name('loan_types.store')->middleware(['auth', 'accessRight:loan_types_create']);
Route::get('loan_types/{loan_type}','LoanTypesController@show')->name('loan_types.show')->middleware(['auth', 'accessRight:loan_types_view']);
Route::get('loan_types/{loan_type}/edit', 'LoanTypesController@edit')->name('loan_types.edit')->middleware(['auth', 'accessRight:loan_types_edit']);
Route::patch('loan_types/{loan_type}', 'LoanTypesController@update')->name('loan_types.update')->middleware(['auth', 'accessRight:loan_types_edit']);
Route::delete('loan_types/{loan_type}', 'LoanTypesController@destroy')->name('loan_types.destroy')->middleware(['auth', 'accessRight:loan_types_delete']);

// Route::resource('members', 'MembersController')->names(['name' => ['index' => 'members.index']])->middleware('auth');
// Route::resource('signatories', 'SignatoriesController')->names(['name' => ['index' => 'signatories.index']])->middleware('auth');
// Route::resource('loan_types', 'LoanTypesController')->names(['name' => 'loan_types.index'])->middleware('auth');

Route::get('shares', 'SharesController@index')->name('shares.index')->middleware(['auth', 'accessRight:shares_view']);
Route::get('shares/create', 'SharesController@create')->name('shares.create')->middleware(['auth', 'accessRight:shares_create']);
Route::post('shares', 'SharesController@store')->name('shares.store')->middleware(['auth', 'accessRight:shares_create']);
Route::get('shares/{share}', 'SharesController@show')->name('shares.show')->middleware(['auth', 'accessRight:shares_view']);

Route::get('loans', 'LoansController@index')->name('loans.index')->middleware('auth');
Route::get('loans/create', 'LoansController@create')->name('loans.create')->middleware('auth');
Route::post('loans', 'LoansController@store')->name('loans.store')->middleware('auth');
