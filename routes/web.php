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

// USERS
Route::get('user/profile/{user}', 'UsersController@profile')->name('users.profile')->middleware('auth');
Route::patch('user/update_avatar/{user}', 'UsersController@update_avatar')->name('users.update_avatar')->middleware('auth');
Route::get('users', 'UsersController@index')->name('users.index')->middleware(['auth', 'accessRight:user_view_list']);
Route::get('users/show_rights/{user}', 'UsersController@show_rights')->name('users.show_rights')->middleware(['auth', 'accessRight:invoke_rights,user_view_list']);
Route::patch('users/update_rights/{user}', 'UsersController@update_rights')->name('users.update_rights')->middleware(['auth', 'accessRight:invoke_rights,user_view_list']);
Route::delete('users/{user}', 'UsersController@destroy')->name('users.destroy')->middleware(['auth', 'accessRight:user_delete,user_view_list']);

// MEMBERS
Route::get('members', 'MembersController@index')->name('members.index')->middleware(['auth', 'accessRight:member_view_list']);
Route::get('members/create', 'MembersController@create')->name('members.create')->middleware(['auth', 'accessRight:member_create,member_view_list']);
Route::post('members', 'MembersController@store')->name('members.store')->middleware(['auth', 'accessRight:member_create,member_view_list']);
Route::get('members/{member}','MembersController@show')->name('members.show')->middleware(['auth', 'accessRight:member_view,member_view_list']);
Route::get('members/{member}/edit', 'MembersController@edit')->name('members.edit')->middleware(['auth', 'accessRight:member_edit,member_view_list,member_view']);
Route::patch('members/{member}', 'MembersController@update')->name('members.update')->middleware(['auth', 'accessRight:member_edit,member_view_list,member_view']);
Route::delete('members/{member}', 'MembersController@destroy')->name('members.destroy')->middleware(['auth', 'accessRight:member_delete,member_view_list']);

// SIGNATORIES
Route::get('signatories', 'SignatoriesController@index')->name('signatories.index')->middleware(['auth', 'accessRight:signatories_view_list']);
Route::get('signatories/create', 'SignatoriesController@create')->name('signatories.create')->middleware(['auth', 'accessRight:signatories_create,signatories_view_list']);
Route::post('signatories', 'SignatoriesController@store')->name('signatories.store')->middleware(['auth', 'accessRight:signatories_create,signatories_view_list']);
Route::get('signatories/{signatory}/edit', 'SignatoriesController@edit')->name('signatories.edit')->middleware(['auth', 'accessRight:signatories_edit,signatories_view_list']);
Route::patch('signatories/{signatory}', 'SignatoriesController@update')->name('signatories.update')->middleware(['auth', 'accessRight:signatories_edit,signatories_view_list']);
Route::delete('signatories/{signatory}', 'SignatoriesController@destroy')->name('signatories.destroy')->middleware(['auth', 'accessRight:signatories_delete,signatories_view_list']);

// LOAN TYPES
Route::get('loan_types', 'LoanTypesController@index')->name('loan_types.index')->middleware(['auth', 'accessRight:loan_types_view_list']);
Route::get('loan_types/create', 'LoanTypesController@create')->name('loan_types.create')->middleware(['auth', 'accessRight:loan_types_create,loan_types_view_list']);
Route::post('loan_types', 'LoanTypesController@store')->name('loan_types.store')->middleware(['auth', 'accessRight:loan_types_create,loan_types_view_list']);
Route::get('loan_types/{loan_type}','LoanTypesController@show')->name('loan_types.show')->middleware(['auth', 'accessRight:loan_types_view,loan_types_view_list']);
Route::get('loan_types/{loan_type}/edit', 'LoanTypesController@edit')->name('loan_types.edit')->middleware(['auth', 'accessRight:loan_types_edit,loan_types_view_list']);
Route::patch('loan_types/{loan_type}', 'LoanTypesController@update')->name('loan_types.update')->middleware(['auth', 'accessRight:loan_types_edit,loan_types_view_list']);
Route::delete('loan_types/{loan_type}', 'LoanTypesController@destroy')->name('loan_types.destroy')->middleware(['auth', 'accessRight:loan_types_delete,loan_types_view_list']);

// SHARES
Route::get('shares', 'SharesController@index')->name('shares.index')->middleware(['auth', 'accessRight:shares_view_list']);
Route::get('shares/create', 'SharesController@create')->name('shares.create')->middleware(['auth', 'accessRight:shares_create,shares_view_list']);
Route::post('shares', 'SharesController@store')->name('shares.store')->middleware(['auth', 'accessRight:shares_create,shares_view_list']);
Route::get('shares/{member}', 'SharesController@show')->name('shares.show')->middleware(['auth', 'accessRight:shares_view,member_view,member_view_list']);

// LOANS
Route::get('loans', 'LoansController@index')->name('loans.index')->middleware(['auth', 'accessRight:loans_view_list']);
Route::get('loans/create', 'LoansController@create')->name('loans.create')->middleware(['auth', 'accessRight:loans_create,loans_view_list']);
Route::post('loans', 'LoansController@store')->name('loans.store')->middleware(['auth', 'accessRight:loans_create,loans_view_list']);
Route::get('loans/{loan}', 'LoansController@show')->name('loans.show')->middleware(['auth', 'accessRight:loans_view,loans_view_list']);
Route::delete('loans/{loan}', 'LoansController@destroy')->name('loans.destroy')->middleware(['auth', 'accessRight:loans_delete,loans_view_list']);

// PAYMENT SCHEDULES
Route::patch('payment_schedule/up/{loan}/{payment_schedule}', 'PaymentSchedulesController@paymentUp')->name('payment_schedule.up')->middleware(['auth', 'accessRight:loans_edit,loans_view_list']);
Route::patch('payment_schedule/down/{loan}/{payment_schedule}', 'PaymentSchedulesController@paymentDown')->name('payment_schedule.down')->middleware(['auth', 'accessRight:loans_edit,loans_view_list']);

// TRANSACTIONS
Route::get('transactions', 'TransactionsController@index')->name('transactions.index')->middleware(['auth', 'accessRight:transacions_view_list']);
Route::get('transactions/create', 'TransactionsController@create')->name('transactions.create')->middleware(['auth', 'accessRight:transactions_create,transactions_view_list']);
Route::post('transactions', 'TransactionsController@store')->name('transactions.store')->middleware(['auth', 'accessRight:transactions_create,transactions_view_list']);
Route::delete('transactions/{transaction}', 'TransactionsController@destroy')->name('transactions.destroy')->middleware(['auth', 'accessRight:transactions_delete,transactions_view_list']);

// CHART OF ACCOUNTS
Route::get('chart_of_accounts', 'AccountsController@index')->name('accounts.index')->middleware(['auth', 'accessRight:chart_of_accounts_view_list,chart_of_accounts_create']);