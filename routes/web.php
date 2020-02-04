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

Route::get('/','BaseController@Home')->name('home');
Route::get('workers','BaseController@Workers')->name('Workers');
Route::get('create/worker','BaseController@CreateWorker')->name('CreateWorker');
Route::get('departments','BaseController@Departments')->name('Departments');
Route::get('create/departments','BaseController@CreateDepartment')->name('CreateDepartment');
Route::get('edit/department','BaseController@EditDepartment')->name('EditDepartment');
Route::get('delete/department/{id?}','BaseController@DeleteDepartment')->name('DeleteDepartment');

Route::get('edit/worker','BaseController@EditWorker')->name('EditWorker');
Route::get('delete/worker/{id?}','BaseController@DeleteWorker')->name('DeleteWorker');

