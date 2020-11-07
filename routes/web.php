<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('invoices','InvoicesController');
Route::resource('sections','SectionsController');
Route::resource('products','ProductsController');
Route::resource('InvoiceAttachments','InvoiceAttachmentsController');
Route::resource('categories','CategoriesController');
Route::resource('suppliers','SupplierController');
//Route::get('categories','CategoriesController@store')->name('categories');

Route::get('/section/{id}','InvoicesController@getproducts');
Route::get('/edit_invoice/{id}','InvoicesController@edit');
Route::get('/Status_show/{id}','InvoicesController@show')->name('Status_show');
Route::post('/Status_Update/{id}','InvoicesController@update_status')->name('Status_Update');
Route::get('Invoice_Paid','InvoicesController@Invoice_Paid');
Route::get('Invoice_UnPaid','InvoicesController@Invoice_UnPaid');
Route::get('Print_invoice/{id}','InvoicesController@Print_invoice')->name('Print_invoice');
Route::get('Invoice_Partial','InvoicesController@Invoice_Partial');
Route::post('trash_invoce','InvoicesController@Trash_Invoice')->name('trash_invoce');
Route::get('view_trash_invoce','InvoiceArchiveController@index');
Route::post('restore_archive','InvoiceArchiveController@restore_Archive')->name('restore_archive');
Route::post('delete_archive_invoice','InvoiceArchiveController@DeleteArchive')->name('delete_archive_invoice');
// Route::get('invoices','InvoicesController@update_status')->name('invoices');
//Route::get('/delete_invoice/{id}','InvoicesController@edit');
Route::get('InvoicesDetails/{id}','InvoicesDetailsController@edit');
Route::get('view_file/{file_name}/{invoice_number}','InvoicesDetailsController@open_file');
Route::get('download/{file_name}/{invoice_number}','InvoicesDetailsController@get_file');
// Route::post('invoices','InvoicesController@update');
Route::post('delete_file','InvoicesDetailsController@destroy')->name('delete_file');

Route::get('export', 'InvoicesController@export')->name('export');



Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
   
    });



Route::get('/{page}', 'AdminController@index');
