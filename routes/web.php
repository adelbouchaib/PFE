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


Route::get('/login','LoginController@formLogin')->name('login')->middleware('guest');
Route::post('/login','LoginController@actionLogin')->name('action.login');


Route::get('/','DashboardController@index')->name('dashboard.index');
Route::get('/logout','DashboardController@logout')->name('logout');

Route::get('/users','UserController@index')->name('dashboard.users.index');
Route::get('/users/{id}','UserController@employee')->name('dashboard.users.employee');
Route::post('/users/create','UserController@store')->name('dashboard.users.create');

Route::post('/users/edit','UserController@edit')->name('dashboard.users.edit');
Route::post('/users/update','UserController@update')->name('dashboard.users.update');
Route::post('/users/delete','UserController@destroy')->name('dashboard.users.delete');

Route::get('/attendances','AttendanceController@index')->name('dashboard.attendances.index');
Route::post('/attendances/start','AttendanceController@startWork')->name('dashboard.attendances.start');
Route::post('/attendances/finish','AttendanceController@finishWork')->name('dashboard.attendances.finish');