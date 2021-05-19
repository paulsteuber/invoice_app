<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Auth::routes();

Route::get('/dashboard','HomeController@index')->name('home');

/**
 *  PROFILE
 */
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::post('/profile', 'ProfileController@store')->name('profile.store');
Route::patch('/profile/{profile_id}', 'ProfileController@update')->name('profile.update');
Route::get('/json/auth/profile', 'ProfileController@show_profile')->name('profile.show_profile');
/**
 *  CUSTOMER
 */
Route::get('/customers', 'CustomersController@index')->name('customers');
Route::get('/customer', 'CustomersController@create')->name('customer.create');
Route::post('/customer', 'CustomersController@store')->name('customer.store');
Route::get('/customer/{customer_id}/edit', 'CustomersController@edit')->name('customer.edit');
Route::patch('/customer/{customer_id}', 'CustomersController@update')->name('customer.update');
Route::get('/json/auth/customers', 'CustomersController@show_customers')->name('customers.show_customers');

/**
 *  INVOICE
 */
Route::get('/invoices','InvoicesController@index')->name('invoice.index');
Route::get('/invoice','InvoicesController@create')->name('invoice.create');
Route::post('/invoice', 'InvoicesController@store')->name('invoice.store');
Route::get('/invoice/{invoice_id}/edit', 'InvoicesController@edit')->name('invoice.edit');
Route::get('/json/auth/invoice/{invoice_id}', 'InvoicesController@show_invoice')->name('invoice.show_invoice');
Route::patch('/invoice/{invoice_id}', 'InvoicesController@update')->name('invoice.update');